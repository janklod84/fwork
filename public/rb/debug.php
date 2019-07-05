<?php

// Pretty Print Array data
function debug($arr, $die = false)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    if($die) die;
}


// Die and Dump array
function dd($arr)
{
    echo '<pre>';
    var_dump($arr);
    echo '</pre>';
    die;
}
