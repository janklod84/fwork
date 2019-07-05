<?php
namespace Project\Container;


// Class Register [ Registry ]
class Registry
{
    public static $objects = [];
    protected static $instance;


    protected function __construct()
    {
        $config = require_once (ROOT.'/config/app.php');

        foreach($config['components'] as $name => $component)
        {
            self::$objects[$name] = new $component;
        }
    }


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


    public function __get($name)
    {
        // echo $name;
        if(is_object(self::$objects[$name]))
        {
            return self::$objects[$name];
        }
    }


    public function __set($name, $classname)
    {
        if(!isset(self::$objects[$name]))
        {
            self::$objects[$name] = new $classname();
        }
    }



    public function getList()
    {
        echo '<pre>';
        print_r(self::$objects);
        echo '</pre>';
    }
}