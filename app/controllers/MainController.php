<?php
namespace app\controllers;

use app\models\Post;


class MainController extends AppController
{

    // protected  $layout = 'main';


    /**
     * Action index
     *
     * Ex: $post = new Post();
     * simple query for dumping table
     *   $res = $post->query('CREATE TABLE posts2 SELECT * FROM db_work.posts');
     *
     *
     * @return void
     */
    public function indexAction()
    {

        # get all posts
        $posts = \R::findAll('posts');

        # get menu
        $menu = $this->menu;


        # define title
        $title = 'PAGE INDEX';

        # set data
        $this->set(compact('title', 'posts', 'menu'));
    }


}