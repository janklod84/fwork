<?php
use Project\Routing\Router;

// Add routes

# http://work.loc/page/view/about [ alias: may be slug]
# http://work.loc/page/view/contact
# http://work.loc/page/view/1
Router::add('page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)', [
    'controller' => 'Page',
    //'action' => 'index'
]);


# http://work.loc/page/contact
# http://work.loc/page/about
# http://work.loc/page/1
Router::add('page/(?P<alias>[a-z-]+)', [
    'controller' => 'Page',
    'action' => 'view'
]);


// Defaults Rules or Routes [ Later replace by method Route::add(pattern, route)->with('str', 'regexcode') ]
# Ex: http://work.loc/
Router::add('', [
    'controller' => 'Main',
    'action' => 'index'
]);

# this rule help us to write all defaults route we want
Router::add('(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?');