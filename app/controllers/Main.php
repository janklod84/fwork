<?php
namespace app\controllers;


class Main extends AppController
{

    // protected  $layout = 'main';


    public function indexAction()
    {
        # change layout and view inside action
        // $this->layout = 'main';
        // $this->view   = 'test';

        # use other layout for this action
        // $this->layout = 'default';

        # used in case AJAX [We don't need template]
        // $this->layout = false;

        $name = 'Жан-Клод';

        $posts = [
          'title' => 'Article 1',
          'slug'  => 'article-1',
          'content' => 'lorem ipsum thanks you.!'
        ];

        $title = 'PAGE INDEX';

        # $this->>set(['name' => $name, 'posts' => $posts]);
        $this->set(compact('name', 'posts', 'title'));
    }
}