<?php
namespace Project\Routing;


abstract class Controller
{

    /**
     * @var array $route
     * @var string $view
     */
    protected $route = [];
    protected $view;

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
        @include sprintf(APP.'/views/%s/%s.php', $route['controller'], $this->view);
    }
}