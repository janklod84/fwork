<?php
namespace Project\Container;


// Class Register [ Registry ]
class Registry
{

    use Singleton;

    /**
     * @var array $objects
     */
    public static $objects = [];


    /**
     * Registry constructor.
     *
     * @retrun void
     */
    protected function __construct()
    {
        $config = require_once (ROOT.'/config/app.php');

        foreach($config['components'] as $name => $component)
        {
            self::$objects[$name] = new $component;
        }
    }


    /**
     * Get item from container
     *
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        // echo $name;
        if(is_object(self::$objects[$name]))
        {
            return self::$objects[$name];
        }
    }


    /**
     * Set item
     *
     *
     * @param strin $name
     * @param string $classname
     */
    public function __set($name, $classname)
    {
        if(!isset(self::$objects[$name]))
        {
            self::$objects[$name] = new $classname();
        }
    }


    /**
     * Get List
     *
     * @return void
     */
    public function getList()
    {
        echo '<pre>';
        print_r(self::$objects);
        echo '</pre>';
    }
}