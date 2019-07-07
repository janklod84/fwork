<?php
namespace app\controllers;

use Project\Library\Pagination;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPMailer\PHPMailer\PHPMailer;
use Project\Template\View;
use R;


class MainController extends AppController
{


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
     *
     * Ex:
     * # testing Monolog [ Library ]
     * $log = new Logger('name');
     * $log->pushHandler(new StreamHandler(ROOT.'/temp/your.log'), Logger::WARNING);
     *
     * # add records to the log
     *   $log->warning('Foo');
     *   $log->error('Bar');
     *
     * @return void
     */
    public function indexAction()
    {

            # get count all posts
            $total = R::count('posts');

            # get page
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

            # get perpage
            $perpage = 2;


            # instancied pagination & get start page
            $pagination = new Pagination($page, $perpage, $total);
            $start = $pagination->getStart();


            # get all posts from database
            $posts = R::findAll('posts', "LIMIT $start, $perpage");


            # set meta data
            View::setMeta('Blog :: Главная страница', 'Описание страницы', 'Ключивые слова');


            # set data
            $this->set(compact('posts', 'pagination', 'total'));
    }


    /**
     * Action test
     *
     * @return void
     */
    public function testAction()
    {
        // if request is ajax
       if($this->isAjax())
       {
           # DEBUG DATA
           // $post = R::findOne('posts', "id = {$_POST['id']}");
           // debug($post);


           # Exemple JSON ENCODE FAKE DATA
           // $data = ['message' => 'Response from server', 'code' => 200];
           // echo json_encode($data);

           # Exemple WITH NO JSON
           $post = R::findOne('posts', "id = {$_POST['id']}");
           $this->loadView('_test', compact('post'));
           die;
       }
       echo 222;
    }


}