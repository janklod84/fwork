<?php
namespace app\controllers;


class MainController extends AppController
{
    /**
     * Action test
     *
     * @return void
     */
    public function testAction()
    {
        if($this->isAjax())
        {
            die('111');
        }
        die('222');
    }


}