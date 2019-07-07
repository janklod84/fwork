<?php

// Pretty Print Array data
/**
 * @param $arr
 * @param bool $die
 */
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
/**
 * @param $str
 * @return string
 */
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


// Translater
/**
 * @param $key
 * @param $default
 * @return string
 */
function __t($key, $default='') // or named function __($key, $default='') {}
{
    echo Project\Template\Lang::get($key);
}