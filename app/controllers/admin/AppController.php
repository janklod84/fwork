<?php
namespace app\controllers\admin;

use app\models\BaseModel;
use app\models\User;
use Project\Routing\Controller;
use R;


class AppController extends Controller
{

     protected  $layout = 'admin';


    /**
     * AppController constructor.
     *
     * @param array $route
     * @return void
     */
    public function __construct($route)
    {
        parent::__construct($route);

        // get connection from model
        new \app\models\BaseModel();


        /* debug($route, true); */

        // Condition very important : $route['action'] != 'login' , permit no-conflict recycling redirect
        // if user is not admin , we'll redirect user
        if(!User::isAdmin() && $route['action'] != 'login')
        {
            redirect(ADMIN. '/user/login');
        }
    }

}