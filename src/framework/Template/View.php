<?php
namespace Project\Template;


class View
{
    /**
     * @var array $route
     * @var string $view
     * @var string $layout
     * @var array  $scripts
     */
    private  $route = [];
    private  $view;
    private  $layout;
    private  $scripts = [];


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
         $file_view = sprintf(APP . '/views/%s/%s.php',
              $this->route['controller'],
              $this->view
         );

         // start Bufferisation
         ob_start();

         // verify if view file exist
         if(is_file($file_view))
         {
             // include view file
             require($file_view);

         }else{
             echo sprintf('<p>Not Found view <b>%s</b></p>', $file_view);
         }

         // storage content
         $content = ob_get_clean(); # echo $content;  IDEA (new Response())->setBody($content)) #


         if($this->layout !== false)
         {
             // get full path layout
             $file_layout = sprintf(APP . '/views/layouts/%s.php', $this->layout);

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
                 echo sprintf('<p>Not Found layout <b>%s</b></p>', $file_layout);
             }
         }

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
}