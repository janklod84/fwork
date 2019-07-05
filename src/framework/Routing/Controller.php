<?php
namespace Project\Routing;


use Project\Template\View;



abstract class Controller
{

    /**
     * @var array $route
     * @var string $layout
     * @var string $view
     * @var array  $data
     */
    protected $route = [];
    protected $layout;
    protected $view;
    protected $data = [];


    /**
     * Controller Constructor.
     *
     * @param array $route
     * @return void
     */
    public  function __construct($route)
    {
        $this->route = $route;
        $this->view  = $route['action'];
    }


    /**
     * Get view
     *
     * @return void
     */
    public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->data);
    }


    /**
     * Set data for parsing to view
     *
     *
     * @param array $data
     */
    protected function set($data)
    {
        $this->data = $data;
    }


    /**
     * Determine if request is ajax
     *
     *
     * @return bool
     */
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }


    /**
     * Load View
     *
     *
     * @param $view
     * @param array $data
     */
    public function loadView($view, $data = [])
    {
       extract($data);
       require sprintf(APP . "/views/%s/%s.php", $this->route['controller'], $view);
    }
}