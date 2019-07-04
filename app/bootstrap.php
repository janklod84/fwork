<?php


// Autoloading
require_once '../vendor/autoload.php';

// Class aliases
class_alias('Project\\Routing\\Router', 'Router');

// Load Functions
require '../src/framework/Functions.php';



// Include routes
require_once __DIR__.'/routes.php';