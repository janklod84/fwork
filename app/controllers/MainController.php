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

            // R::fancyDebug(true);

            # get all posts from database
            $posts = R::findAll('posts');

            # get one record post
            $post = R::findOne('posts', 'id = 1');

            # get menu
            $menu = $this->menu;


            # set meta data
            $this->setMeta('Главная страница', 'Описание страницы', 'Ключивые слова');


            # get meta datas
            $meta = $this->meta;

            # set data
            $this->set(compact('posts', 'menu', 'meta'));
    }


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
       echo 222;
    }


}