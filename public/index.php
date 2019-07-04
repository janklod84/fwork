<?php


// Configuration
define('WWW', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) .'/app');


// Load classes and libs
require '../vendor/libs/functions.php';
require '../vendor/core/Router.php';
/*
require '../app/controllers/Main.php';
require '../app/controllers/Posts.php';
require '../app/controllers/PostsNew.php';
*/

spl_autoload_register(function ($classname) {
    $file = sprintf(APP . '/controllers/%s.php', $classname);
    if(file_exists($file))
    {
        require_once $file;
    }
});

// Add routes
require_once __DIR__.'/../app/routes.php';


//echo '<h3>Routes</h3>';
//debug(Router::routes());


// Request: Get URL [ Query String ]
// Later verify if isset QUERY_STRING
$query = rtrim($_SERVER['QUERY_STRING'], '/');

// matched route ?
Router::dispatch($query);
