<?php
namespace app\controllers;


class PageController extends AppController
{

    # http://work.loc/page/view/contact
    # http://work.loc/page/view/about
    # http://work.loc/page/view/1
    # [ contact, about, 1 ... are alias ]
    # we can write what we want , this method is factory multi-callback

    # Compact writting URL
    # http://work.loc/page/contact
    # http://work.loc/page/about
    # http://work.loc/page/1

    public function viewAction()
    {
        debug($this->route);
        echo (__METHOD__);
    }
}