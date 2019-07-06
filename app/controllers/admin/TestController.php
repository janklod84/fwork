<?php
namespace app\controllers\admin;

use app\models\User;
use Project\App;
use Project\Template\View;
use R;


class TestController extends AppController
{


    /**
     * Action index
     *
     * @return void
     */
    public function indexAction()
    {
        echo __METHOD__;
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