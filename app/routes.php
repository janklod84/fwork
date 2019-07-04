<?php

// Add routes
/*
Router::add('posts/add', [
    'controller' => 'Posts',
    'action' => 'add'
]);

Router::add('posts/', [
    'controller' => 'Posts',
    'action' => 'index'
]);
*/

Router::add('pages/?(?P<action>[a-z-]+)?', [
    'controller' => 'Posts',
    //'action' => 'index'
]);

// Defaults Rules or Routes [ Later replace by method Route::add(pattern, route)->with('str', 'regexcode') ]
Router::add('', [
    'controller' => 'Main',
    'action' => 'index'
]);

Router::add('(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?');