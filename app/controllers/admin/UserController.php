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
     * Action test
     *
     * @return void
     */
    public function testAction()
    {
        echo __METHOD__;
    }

}