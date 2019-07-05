<?php
namespace app\controllers;

use app\models\Post;
use Project\App;
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
     * Ex :
     * # verify if data in cache
     * echo date('Y-m-d H:i', time());
     * echo '<br>';
     * $endtime = 1562322408;
     * echo date('Y-m-d H:i', $endtime);
     * @return void
     */
    public function indexAction()
    {

        # get list
        // App::$app->getList();

        R::fancyDebug(true);

        # try to get data from cache
        $posts = App::$app->cache->get('posts');

        # if not data from cache
        if(!$posts)
        {
            # get all posts from database
            $posts = R::findAll('posts');

            # add posts in cache
            App::$app->cache->set('posts', $posts, 3600 * 24); // 1day

        }


        # add posts in cache
         // App::$app->cache->set('posts', $posts); 1h
        App::$app->cache->set('posts', $posts, 3600 * 24); // 1day


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