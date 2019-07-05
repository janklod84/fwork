<?php

# http://work.loc/rb/test.php



# define base root
define('ROOT', dirname(dirname(__DIR__)));



# helper debug
require 'debug.php';


# include Library [ ReadBeanPHP ]
require 'rb.php';


# get database configuration
$db = require ROOT.'/config/db.php';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];


# connection
R::setup($db['dsn'], $db['user'], $db['pass'], $options);


# By default all property table can be modified
# But we want not modify table properties,
# for exemple length of table field, table length by defaut is 191 characteres
# so we'll set next :

R::freeze(true);


# set debug
R::fancyDebug(true);



# determine if has connection
// var_dump(R::testConnection());


// CREATE
/*
# method dispense , return object of type RedBeanPHP\OODBBean Object , categories is name of table
# if table does not exist ReadBean will be create it. and set properties
$category = R::dispense('categories'); // debug($category);

# set property
$category->title = 'Категория 2'; // debug($category);

# save data in to database and return lastInsertID
$id = R::store($category); // echo $id;
*/



// READ
/*
$category = R::load('categories', 2);
# debug($category);

# echo $category->title; // Категория 2
# echo $category['title']; // Категория 2
*/



// UPDATE
/*
$category = R::load('categories', 3);
echo $category->title . '<br>';
$category->title = 'Категория 3';
R::store($category);
echo $category->title;

====================================================

$category = R::dispense('categories');
$category->title = 'Категория 3!!!';
$category->id = 3;
R::store($category);

*/


// DELETE
/*
 * Delete on record
$category = R::load('categories', 2);
R::trash($category);
*/


// DROP TABLE
/* R::wipe('categories'); */



// FIND ALL
/*
$categories = R::findAll('categories');
debug($categories);

===============================================
$categories = R::findAll('categories', 'id > ?', [2]);
debug($categories);

===============================================
$categories = R::findAll('categories', 'title LIKE ?', ['%Brown%']);
debug($categories);
*/

// FIND ONE
/*
$categorie = R::findOne('categories', 'id = ?', [2]);
debug($categorie);
*/