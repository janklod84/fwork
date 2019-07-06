<?php
namespace app\controllers;

use app\models\User;
use Project\App;
use Project\Template\View;
use R;


class UserController extends AppController
{


    /**
     * Action Sign Up [ Register ]
     *
     * @return void
     */
    public function signupAction()
    {
        $data = $_POST;
        if(!empty($data))
        {
            $user = new User();
            $user->load($data);
            // debug($user);
            // debug($data);

            if($user->validate($data))
            {
                die('OK');
            }else{
                die('NO');
            }
            die;
        }
        View::setMeta('Регистрация');
    }


    /**
     * Action Login [ Log in ]
     *
     * @return void
     */
    public function loginAction()
    {

    }


    /**
     * Action Logout
     *
     * @return void
     */
    public function logoutAction()
    {

    }




}