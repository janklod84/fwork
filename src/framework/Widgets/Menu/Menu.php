<?php
namespace Project\Widgets\Menu;


use Project\Library\Cache;
use R;

/**
 * Class Menu
 *
 * @package Project\Widgets\Menu
 */
class Menu
{

    /**
     * @var array $data        [ Data ex: categories ]
     * @var $tree              [ Tree builder]
     * @var string $menuHtml   [ Menu items]
     * @var string $tpl        [ Path to template ]
     * @var string $container  [ Tag surround it's may be 'ul', 'select', ..]
     * @var string $class      [ Menu ]
     * @var string $table      [ Name of table where we fetch categories ]
     * @var $cache             [ Cache Time by default 3600 s = 1h ]
     * @var $cacheKey          [ Cache Key ]
     */
     protected $data;
     protected $tree;
     protected $menuHtml;
     protected $tpl;
     protected $container = 'ul';
     protected $class = 'menu';
     protected $table = 'categories';
     protected $cache = 3600;
     protected $cacheKey = 'data.menu';


     // Ex: for universal class Menu ,
     // we must to define variable named for exemple $fields
     // this fields will be stored table fields
     // public $fields = ['id', 'title', 'parent'];

     // TO Implements
     // protected $options = [];


     /**
      * Menu constructor.
      *
      *  Ex:
      *  echo new \Project\Widgets\Menu\Menu([
      *   // 'tpl' => WWW.'/menu/my_menu.php', 'class' => 'my-menu',
      *      'tpl' => WWW.'/select/select.php',
      *      'container' => 'select',
      *      'class' => 'my-select',
      *      'table' => 'categories',
      *      'cache' => 60, // 60s
      *      'cacheKey' => 'menu_select'
      * ])
      *
      * @param array $options
      * @return void
     */
      public function __construct($options=[])
      {
          $this->tpl = __DIR__.'/menu_tpl.php';
          // $this->options = $options;
          $this->setOptions($options);
          $this->run();
      }


     /**
      * Get Options
      * In this case we don't want to set
      *
      * Ex:
      *  'tpl' => WWW.'/select/select.php',
      *  'container' => 'select',
      *  'class' => 'my-select',
      *  'table' => 'categories',
      *  'cache' => 60, // 60s
      *  'cacheKey' => 'menu_select'
      *
      * @param $key
      * @return mixed
     */
      protected function getOption($key)
      {
           if(!empty($this->options[$key]))
           {
               return $this->options[$key];
           }
      }

      /**
       * Set options
       *
       * @param array $options
       * return void
     */
      protected function setOptions($options)
      {
         foreach($options as $key => $value)
         {
              if(property_exists($this, $key))
              {
                  $this->{$key} = $value;
              }
         }
      }


      /**
       * Show output
       *
       * @return void
      */
      protected function output()
      {
          $html = sprintf('<{container} class="%s">%s</{container}>', $this->class, $this->menuHtml);
          echo str_replace('{container}', $this->container, $html);
      }


      /**
       * Run Menu
       *
       * @return void
      */
      protected function run()
      {
          // Get Instance of Cache
          $cache = new Cache();

          // Try to get menu data from cache [ menu is key of menu data cached ]
          $this->menuHtml = $cache->get($this->cacheKey); // return false if not found data

          // if not cached cached menu [ if($this->>menuHtml === false) { instructions .. } ]
          if(!$this->menuHtml)
          {
              // Get data
              $sql = sprintf('SELECT * FROM `%s`', $this->table);
              $this->data = R::getAssoc($sql); // debug($this->data);

              // Get tree
              $this->tree = $this->getTree();  // debug($this->tree);

              // Get menu
              $this->menuHtml = $this->getMenuHtml($this->tree); // echo $this->>menuHtml

              // Cache menu defined time $cache->set(key, content, seconds)
              $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
          }

          // Render output
          $this->output();


          /*
           OLD

          // Get data
          $sql = sprintf('SELECT * FROM `%s`', $this->table);
          $this->data = R::getAssoc($sql); // debug($this->data);

          // Get tree
          $this->tree = $this->getTree();  // debug($this->tree);

          // Get menu
          $this->menuHtml = $this->getMenuHtml($this->tree); // echo $this->>menuHtml

          // Render output
          $this->output();
          */
      }


     /**
      *  Get tree
      *
      * @return array
     */
      protected function getTree()
      {
          $tree = [];
          $data = $this->data; // copy data

          // if we use directly $this->>data for populate, data'll be losted
          foreach($data as $id => &$node)
          {
               if(!$node['parent'])
               {
                   $tree[$id] = &$node;

               }else{
                   $data[$node['parent']]['childs'][$id] = &$node;
               }
          }

          return $tree;
      }


     /**
      * Get Html menu [ Recursive ]
      *
      * @param array $tree
      * @param string $tab
      * @return string
     */
      public function getMenuHtml($tree, $tab = '')
      {
           $str = '';

           foreach($tree as $id => $category)
           {
               $str .= $this->catToTemplate($category, $tab, $id);
           }
           return $str;
      }


      /**
       * Category to Template
       *
       *
       * @param $category
       * @param $tab
       * @param $id
       * @return string
     */
      public function catToTemplate($category, $tab, $id)
      {
          ob_start();
          require $this->tpl;
          return ob_get_clean();
      }
}