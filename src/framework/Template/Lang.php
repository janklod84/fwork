<?php
namespace Project\Template;


/**
 * Class Lang
 *  Anolog class View
 *
 *
 * @package Project\Template\Lang
 */
class Lang
{
    /**
     * @var array  $lang_data     [ Store All translated data ]
     * @var array  $lang_layout   [ Store All translated data related with layouts ]
     * @var array  $lang_view     [ All translated data related with view content , Ex: for header, sidebar, footer ..etc]
     */
    public static $lang_data   = [];
    public static $lang_layout = [];
    public static $lang_view   = [];


    /**
     * Load view template
     *
     *  self::$lang_data : stored all translated data for current language
     *
     * @param $language [ ex: $language['code'] return en, ru, fr ...]
     * @param $view [ controller/action ]
     * @return void
     */
    public static function load($language, $view)
    {
       $lang_layout = sprintf(APP.'/langs/%s.php', $language['code']);
       $lang_view = sprintf(APP.'/langs/%s/%s/%s.php', $language['code'], $view['controller'], $view['action']);

       // get lang layout params
       if(file_exists($lang_layout))
       {
           self::$lang_layout = require_once($lang_layout);
       }

        // get lang view params
        if(file_exists($lang_view))
        {
            self::$lang_view = require_once($lang_view);
        }

        self::$lang_data = array_merge(self::$lang_layout, self::$lang_view);
    }

    /**
     * Get tranlated params by key
     *
     *  Ex: 'test' => 'Test Work' [ key = test ]
     *
     * @param $key
     * @return string
     */
    public static function get($key)
    {
       return isset(self::$lang_data[$key]) ? self::$lang_data[$key] : $key;
    }


    /*
     *
     * Get tranlated params by key
     *
     *  Ex: 'test' => 'Test Work' [ key = test ]
     *
     * @param $key
     * @param $default
     * @return string
      public static function get($key, $default='')
      {
         return isset(self::$lang_data[$key]) ? self::$lang_data[$key] : $default;
      }
     */
}