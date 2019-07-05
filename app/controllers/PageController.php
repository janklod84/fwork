<?php
namespace app\controllers;



# Exemple : URL
# http://work.loc/page/contact
# http://work.loc/page/about
# http://work.loc/page/1

class PageController extends AppController
{
    /**
     * @return void
     */
    public function viewAction()
    {
        # get menu
        $menu = $this->menu;

        # define title
        $title = 'Страница';

        # set data
        $this->set(compact('title', 'menu'));

        // debug($this->route);
    }
}