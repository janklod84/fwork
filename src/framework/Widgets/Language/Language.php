<?php
namespace Project\Widgets\Language;


use Project\App;

/**
 * Class Language
 *
 * @package Project\Widgets\Language
 */
class Language
{

     /**
      * @var string $tpl        [ Path to template ]
      * @var array  $languages  [ Languages storage ]
      * @var string $language   [ Current Active Language ]
     */
      protected $tpl;
      protected $languages;
      protected $language;


      public function __construct()
      {
          $this->tpl = __DIR__.'/lang_tpl.php';
          $this->run();
      }


      /**
       * Run Language widget
     */
      protected function run()
      {
          // get list of all languages
          $this->languages = App::$app->get('langs');

          // get current language
          $this->language  = App::$app->get('lang');

          // show html
          echo $this->getHtml();
      }


     /**
      * Get languages list from Database
      * ORDER BY base DESC  because base = 1 will be always the first.
      *
      *
      * @return array
     */
      public static function getLanguages()
      {
          return \R::getAssoc('SELECT code, title, base FROM languages ORDER BY base DESC');
      }


     /**
      * Get current language
      *
      * @param $languages [ List of all languages ]
      * @return string
     */
      public static function getLanguage($languages)
      {
          // if current code lnaguage exist , and if code language exist inside lists alloweds languages
          if(isset($_COOKIE['lang']) && array_key_exists($_COOKIE['lang'], $languages))
          {
               $key = $_COOKIE['lang'];
          }else{
               $key = key($languages); // key(): get first key of array, default key
          }

          // save data active language [ ru, en ...]
          $lang = $languages[$key];

          // save code active language
          $lang['code'] = $key;

          // current language
          return $lang;
      }


     /**
      * Get HTML code
      *
      * @return string
     */
      protected function getHtml()
      {
          ob_start();
          require_once $this->tpl;
          return ob_get_clean(); // synthese of: ob_get_contents() and ob_clean()
      }

}