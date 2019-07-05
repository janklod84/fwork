<?php
namespace app\controllers;

use app\models\BaseModel;
use Project\Routing\Controller;
use R;

class AppController extends Controller
{

    protected $menu;

    /**
     * AppController constructor.
     *
     * @param array $route
     */
    public function __construct($route)
    {
        parent::__construct($route);

        // must to call any model
        // [ instantier n'importe quel model afin d'avoir acces a la connection
        // pour executer les requettes
        new BaseModel();

        // get menu
        $this->menu = R::findAll('categories');
    }

}