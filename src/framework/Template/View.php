<?php
namespace Project\Template;


use Exception;



class View
{
    /**
     * @var array $route
     * @var string $view
     * @var string $layout
     * @var array  $scripts
     * @var array  $meta
     */
    private  $route = [];
    private  $view;
    private  $layout;
    private  $scripts = [];
    private static $meta = [
        'title'    => '',
        'desc'     => '',
        'keywords' => ''
    ];


    /**
     * View constructor.
     *
     * @param array $route
     * @param string $layout
     * @param string $view
     * @return void
     */
    public function __construct($route, $layout = '', $view='')
    {
         // assign route params
         $this->route = $route;

         // get layout
         if($layout === false)
         {
             $this->layout = false;
         }else{
             $this->layout = $layout ?: LAYOUT;
         }

         // get view
         $this->view = $view;
    }


    /**
     * Render view
     *
     *
     * @param array $data
     */
    public function render(array $data = [])
    {
         extract($data);

         // get full path view
         $file_view = sprintf(APP . '/views/%s%s/%s.php',
              $this->route['prefix'],
              $this->route['controller'],
              $this->view
         );

         $file_view = $this->normalisePath($file_view);

         // start Bufferisation
         ob_start();

         // verify if view file exist
         if(is_file($file_view))
         {
             // include view file
             require($file_view);

         }else{
             // echo sprintf('<p>Not Found view <b>%s</b></p>', $file_view);
              throw new Exception(sprintf('<p>Not Found view <b>%s</b></p>', $file_view), 404);
         }

         // storage content
         $content = ob_get_clean(); # echo $content;  IDEA (new Response())->setBody($content)) #


         if($this->layout !== false)
         {
             // get full path layout
             $file_layout = sprintf(APP . '/views/layouts/%s.php', $this->layout);
             $file_layout = $this->normalisePath($file_layout);

             // verify if layout file exist
             if(is_file($file_layout))
             {
                 $content = $this->getScript($content); # debug($this->scripts);
                 $scripts = [];

                 # if has scripts
                 if(!empty($this->scripts[0]))
                 {
                     $scripts = $this->scripts[0];
                 }

                 // debug($scripts);

                 // include layout
                 require($file_layout);

             }else{
                 // echo sprintf('<p>Not Found layout <b>%s</b></p>', $file_layout);
                 throw new Exception(sprintf('<p>Not Found layout <b>%s</b></p>', $file_layout), 404);
             }
         }

    }

    /**
     * Normalise Path
     *
     * @param $path
     * @return mixed
     */
    protected function normalisePath($path)
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }

    /**
     * Get script from content
     *
     * [ .*? ] does mean may be something or not
     *
     * @param string $content
     * @return string
     */
    protected function getScript($content)
    {

        # regex
        $pattern = "#<script.*?>.*?</script>#si";

       # if finded matches scripts , we'll add them to $this->>scripts
       preg_match_all($pattern, $content, $this->scripts);

       # if has scripts
       if(!empty($this->scripts))
       {
            # we'll replacae pattenr by empty string in content
            $content = preg_replace($pattern, '', $content);
       }
       return $content;
    }


    /*
     * Get meta data
     *
     * @return string
     */
    public static function getMeta()
    {
        $html  = '<title>'. self::$meta['title'] . '</title>'. PHP_EOL;
        $html .= '<meta name="description" content="'. self::$meta['desc'] .'">'. PHP_EOL;
        $html .= '<meta name="keywords" content="'. self::$meta['keywords'] .'">'. PHP_EOL;
        return $html;
    }


    /**
     * Set meta datas
     *
     *
     * @param string $title
     * @param string $desc
     * @param string $keywords
     * @return void
     */
    public static function setMeta($title='', $desc='', $keywords='')
    {
       self::$meta['title'] = $title;
       self::$meta['desc']  = $desc;
       self::$meta['keywords'] = $keywords;
    }
}