<?php
namespace app\controllers;

use app\models\BaseModel;
use Project\Routing\Controller;
use R;

class AppController extends Controller
{

    protected $menu;
    protected $meta;



    /**
     * AppController constructor.
     *
     * @param array $route
     */
    public function __construct($route)
    {
        parent::__construct($route);

        // Must to call any model or BaseModel
        // Ici on instantie n'importe quel model afin d'avoir acces a la connection
        new BaseModel();

        // get menu
        $this->menu = R::findAll('categories');
    }


    /**
     * Set meta data
     *
     * ex:
     * <title>MyBlog</title>
     * <meta name='description' content="this is the content of meta description  ..">
     * <meta name='keywords' content="this is the content of meta keywords  ..">
     *
     * @param  string $title
     * @param  string $desc
     * @param  string $keywords
     * @return void
     */
    protected function setMeta($title = '', $desc = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['desc']  = $desc;
        $this->meta['keywords'] = $keywords;
    }

}