<?php
namespace app\controllers;


class PostsController extends  AppController
{

     public function indexAction()
     {
        echo (__METHOD__);
     }

     public function testAction()
     {
         // debug($this->route);
         echo (__METHOD__);
     }
}