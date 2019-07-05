<?php
namespace app\controllers;

use app\models\Post;
use R;


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
        $posts = R::findAll('posts');


        # get menu
        $menu = $this->menu;


        # set meta data
        $this->setMeta('Главная страница', 'Описание страницы', 'Ключивые слова');

        # set meta data from database / get one record post
        $post = R::findOne('posts', 'id = 2');  // debug($post);
        $this->setMeta($post->title, $post->description, $post->keywords);


        # get meta datas
        $meta = $this->meta;

        # set data
        $this->set(compact('posts', 'menu', 'meta'));
    }


    public function testAction()
    {
        // page sans menu
        # $this->layout = 'test';
    }


}