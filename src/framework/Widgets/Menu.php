<?php
namespace Project\Widgets;


use R;

/**
 * Class Menu
 *
 * @package Project\Widgets\Menu
 */
class Menu
{

    /**
     * @var array $data        [ Data ]
     * @var $tree              [ Tree ]
     * @var string $menuHtml
     * @var string $tpl        [ Path to template ]
     * @var string $container  [ Tag surround it's may be 'ul', 'select', ..]
     * @var string $table      [ Name of table where we fetch categories ]
     * @var $cache             [ Determine if cache menu or not ]
     */
     protected $data;
     protected $tree;
     protected $menuHtml;
     protected $tpl;
     protected $container;
     protected $cache;


     // Ex: for universal class Menu ,
     // we must to define variable named for exemple $fields
     // this fields will be stored table fields
     // public $fields = ['id', 'title', 'parent'];


      public function __construct()
      {
          // echo __METHOD__;
          $this->run();
      }


      /**
       * Run Menu
       *
      */
      protected function run()
      {
          $this->data = R::getAssoc('SELECT * FROM `categories`'); // debug($this->data);
          $this->tree = $this->getTree();  debug($this->tree);
      }


     /**
      *  Get tree
      *
      * @return array
     */
      protected function getTree()
      {
          $tree = [];
          $data = $this->data;

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
      * Get Html menu
      *
      * @param array $tree
      * @param string $tab
      * @return string
     */
      protected function getMenuHtml($tree, $tab = '')
      {

      }


      /**
       * Category to Template
       *
       *
       * @param $category
       * @param $tab
       * @param $id
     */
      protected function catToTemplate($category, $tab, $id)
      {

      }
}