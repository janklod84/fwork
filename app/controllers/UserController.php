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
        // echo password_hash('admin123', PASSWORD_DEFAULT);

        $data = $_POST;
        if(!empty($data))
        {
            $user = new User();
            $user->load($data);
            // debug($user);
            // debug($data);

            // if data not valide and item data already exist
            if(!$user->validate($data) || !$user->checkUnique())
            {
                // we'll display errors and redirect where he's from
                $user->getErrors();

                // storage form data in session
                $_SESSION['form_data'] = $data;

                // redirect user where is from
                redirect();
            }

            // set password before saving or storage
            $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);


            // If user saved
            if($user->save())
            {
                // we'll write message success
                $_SESSION['success'] = 'Вы успешно зарегистрированы!';

            }else{

                // we'll write error message
                $_SESSION['error'] = 'Ошибка! Попробуйте позже';
            }
            redirect();
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
        if(!empty($_POST))
        {
             $user = new User();

             if($user->login())
             {
                 // we'll write message success
                 $_SESSION['success'] = 'Вы успешно авторизован!';

             }else{

                 // we'll write error message
                 $_SESSION['error'] = 'Логин/пароль введены неверно';
             }

             // redirect();
            redirect('/');
        }
        View::setMeta('Вход');
    }


    /**
     * Action Logout
     *
     * @return void
     */
    public function logoutAction()
    {
        if(isset($_SESSION['user']))
        {
             unset($_SESSION['user']);
             redirect('/user/login');
        }
    }




}