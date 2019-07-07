<?php
namespace app\controllers\admin;

use Project\Library\Pagination;
use Project\Template\View;
use Project\App;
use R;



/**
 * @link https://adminlte.io/themes/AdminLTE/index2.html
 * @link https://github.com/ColorlibHQ/AdminLTE
 *
 * MainController here can be replaced by DashboardController
 */
class MainController extends AppController
{


    /**
     * Action index
     *
     * @return void
     */
    public function indexAction()
    {
        $posts = R::findAll('posts');
        $this->set(compact('posts'));
    }




}