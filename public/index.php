<?php

// Query string
$query = rtrim($_SERVER['QUERY_STRING'], '/');

// Load classes and libs
require '../vendor/libs/functions.php';
require '../vendor/core/Router.php';


// Add routes
Router::add('posts/add', [
    'controller' => 'Posts',
    'action' => 'add'
]);

Router::add('posts/', [
    'controller' => 'Posts',
    'action' => 'index'
]);


Router::add('', [
    'controller' => 'Main',
    'action' => 'index'
]);


echo '<h3>Routes</h3>';
debug(Router::routes());

// matched route ?
if(Router::match($query))
{
    echo '<h3>Current route</h3>';
    debug(Router::route());

}else{
    die('<h3>404 Page not found</h3>');
}