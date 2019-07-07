<?php
namespace app\controllers;


use Project\Template\View;
use Project\App;
use R;


class LanguageController extends AppController
{


    /**
     * Action change
     *
     *  see more in file : /public/blog/js/main.js
     *  window.location = '/language/change?lang=' + $(this).val();
     *
     * @return void
     */
    public function changeAction()
    {
        $lang = !empty($_GET['lang']) ? $_GET['lang'] : null; // debug($lang);

        // if not empty $lang
        if($lang)
        {
            // if key exist in lists alloweds languages
            if(array_key_exists($lang, App::$app->get('langs')))
            {
                 // we'll add in cookie [ 1 week : 1 semaine ]
                 setcookie('lang', $lang, time() + 3600 * 24 * 7, '/');
            }

            redirect();
        }
    }



}