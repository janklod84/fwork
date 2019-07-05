<?php
namespace Project\Container;


trait Singleton
{
    /**
     * @var object $instance
     */
    protected static $instance;


    /**
     * Get instance of Database
     *
     * @return self
     */
    public static function instance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
}