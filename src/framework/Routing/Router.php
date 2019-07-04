<?php
namespace Project\Routing;


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
         $regex = '#^'. trim($pattern, '/') . '$#i';
         self::$routes[$regex] = $route;
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
         // populate routes
         foreach(self::$routes as $pattern => $route)
         {
             // is matched ?
            if(preg_match($pattern, $url,$matches))
            {
                // Get route params [ append route ]
                foreach($matches as $key => $value)
                {
                    if(is_string($key))
                    {
                        $route[$key] = $value;
                    }
                }

                // if has not key 'action' or not isset 'action'
                if(!isset($route['action']))
                {
                    $route['action'] = 'index';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
         }
         return false;
     }


    /**
     * Dispatch matched route [ Call action for current route ]
     *
     * @param string $url
     * @return mixed
     */
     public static function dispatch($url)
     {
         // remove query string
         $url = self::removeQueryString($url);

         // process dispatching route
         if(self::match($url))
         {
             $controller = sprintf('app\controllers\\%s', self::$route['controller']);

             if(class_exists($controller))
             {
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']).'Action';
                if(method_exists($cObj, $action))
                {
                    // call controller and action
                    call_user_func([$cObj, $action]);

                    // get current view

                }else{

                    die(sprintf('Method <b>%s::%s</b> does not exist!', $controller, $action));
                }

             }else{
                 die(sprintf('Controller <b>%s</b> does not exist!', $controller));
             }

         }else{

             // Response
             http_response_code(404);
             include '404.html';
         }
     }


    /**
     * Transform given param to Upper case
     *
     *  Ex: posts-new => PostsNew
     *
     * @param string $name
     * @return string
     */
     protected static function upperCamelCase($name)
     {
         /*
         $name = str_replace('-', ' ', $name);
         $name = ucwords($name);
         $name = str_replace(' ', '', $name);
         return $name;
         */

         return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
     }


    /**
     * Transform given param to Lower case
     *
     * test-page => testPage
     *
     * @param $name
     * @return mixed
     */
     public static function lowerCamelCase($name)
     {
         return lcfirst(self::upperCamelCase($name));
     }


    /**
     * Remove Query string
     *
     *  URL: http://work.loc/posts-new/test?page=2
     * [ echo $url; show: posts-new/test&page=2 ]
     *
     *
     * @param string $url
     * @return string
     */
     protected static function removeQueryString($url)
     {
          //  echo $url;
          if($url)
          {
              $params = explode('&', $url, 2); // debug($params);
              if(strpos($params[0], '=') === false) // page/part1..
              {
                  return rtrim($params[0], '/');
              }else{ // page = something
                  return '';
              }
          }

     }
}