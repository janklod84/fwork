<?php
//error_reporting(E_ALL);
error_reporting(-1);



// Configuration
define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('CORE', ROOT.'/vendor/project/core');
define('APP', ROOT .'/app');
define('LAYOUT', 'default');


// Bootstrap
require_once realpath(__DIR__.'/../app/bootstrap.php');



// Request: Get URL [ Query String ]
// Later verify if isset QUERY_STRING
$query = rtrim($_SERVER['QUERY_STRING'], '/');

// matched route ?
Router::dispatch($query);
