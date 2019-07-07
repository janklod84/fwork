<?php
namespace app\controllers\admin;

use app\models\User;
use Project\App;
use Project\Template\View;
use R;


class UserController extends AppController
{


    /**
     * Action index
     *
     * @return void
     */
    public function indexAction()
    {
        View::setMeta('Админка :: Главная страница', 'Описание админки', 'Ключевики админки');

        $test = 'Тестовая переменная';
        $data = ['test', '2'];
        $this->set(compact('test', 'data'));
    }

    /**
     * Action Login
     *
     * die(password_hash('admin123', PASSWORD_DEFAULT));
     *
     * @return void
     */
    public function loginAction()
    {

        if(!empty($_POST))
        {
            $user = new User();

            // if not find admin
            if(!$user->login(true))
            {
                $_SESSION['error'] = 'Логин/Пароль введены неверно!';
            }

            // verify admin
            if(User::isAdmin())
            {
                 redirect(ADMIN);
            }else{
                 redirect();
            }
        }
        $this->layout = 'login';
    }

}