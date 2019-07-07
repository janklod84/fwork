<?php

// Pretty Print Array data
function debug($arr, $die = false)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    if($die) die;
}


// Method redirect [ $http is url where we want to redirect user. ]
// can be write $url or $to ..
function redirect($http = false)
{
     if($http)
     {
         $redirect = $http;
     }else{
         $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
     }
     header(sprintf('Location: %s', $redirect));
     exit;
}


// Escapce bad str
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}