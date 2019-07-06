<?php
namespace app\controllers\admin;

use app\models\BaseModel;
use Project\Routing\Controller;
use R;


class AppController extends Controller
{

     protected  $layout = 'admin';


    /**
     * AppController constructor.
     *
     * @param array $route
     */
    public function __construct($route)
    {
        parent::__construct($route);

        /*
        if(!isset($is_admin) || $is_admin !== 1)
        {
             // or do redirect to /admin/login
             die('Access Restricted!');
        }
        */
    }

}