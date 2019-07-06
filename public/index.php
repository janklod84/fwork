<?php


// Configuration
# Debogger status
define('DEBUG', 1);

# Paths
define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('APP', ROOT .'/app');
define('CORE', ROOT.'/src');
define('CACHE', ROOT .'/temp/cache');
define('LIBS', CORE.'/libs');
define('LAYOUT', 'default');



// Bootstrap
require_once realpath(__DIR__.'/../app/bootstrap.php');



new \Project\App();


// Request: Get URL [ Query String ]
// Later verify if isset QUERY_STRING
$query = rtrim($_SERVER['QUERY_STRING'], '/');

// matched route ?
Router::dispatch($query);
