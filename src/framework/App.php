<?php
namespace Project;


use Project\Container\Registry;
use Project\Exception\ErrorHandler;


/**
 * Class App
 *
 * @package Projec\App
 */
class App
{

    /**
     * @var Registry $app
     */
    public static $app;


    /**
     * App constructor.
     *
     * @return void
     */
    public function __construct()
    {
        self::$app = Registry::instance();
        new ErrorHandler();
    }
}