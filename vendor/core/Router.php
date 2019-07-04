<?php



class Router
{

    /**
     * @var array $routes [ Table of routes ]
     * @var array $route  [ Route params ]
     */
     protected static $routes = [];
     protected static $route  = [];


    /**
     * Add routes
     *
     * @param $pattern
     * @param $route
     */
     public static function add($pattern, $route = [])
     {
         $pattern = trim($pattern, '/');
         self::$routes[$pattern] = $route;
     }


    /**
     * Get table of routes
     *
     * @return array
     */
     public static function routes()
     {
         return self::$routes;
     }


    /**
     * Get params current route
     *
     * @return array
     */
     public static function route()
     {
         return self::$route;
     }


    /**
     * Determine if current route match request URL
     *
     * @param string $url
     * @return bool
     */
     public static function match($url)
     {
         foreach(self::$routes as $pattern => $route)
         {
            if($url === $pattern)
            {
                self::$route = $route;
                return true;
            }
         }
         return false;
     }
}