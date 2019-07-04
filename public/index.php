<?php
//error_reporting(E_ALL);
error_reporting(-1);


use Project\Routing\Router;



// Configuration
define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('CORE', ROOT.'/vendor/project/core');
define('APP', ROOT .'/app');


// Load classes and libs
require '../src/framework/Functions.php';
require_once '../vendor/autoload.php';



// Add routes
require_once __DIR__.'/../app/routes.php';


//echo '<h3>Routes</h3>';
debug(Router::routes());


// Request: Get URL [ Query String ]
// Later verify if isset QUERY_STRING
$query = rtrim($_SERVER['QUERY_STRING'], '/');

// matched route ?
Router::dispatch($query);
