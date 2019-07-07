<?php
namespace Project\Container;


// Class Register [ Registry ]
class Registry
{

    use Singleton;

    /**
     * @var array $properties
     */
    public static $properties = [];


    /**
     * Set property
     *
     * @param $name
     * @param $value
     * @return void
     */
    public function set($name, $value)
    {
        self::$properties[$name] = $value;
    }


    /**
     * Get property
     *
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        if(isset(self::$properties[$name]))
        {
            return self::$properties[$name];
        }
        return null;
    }


    /**
     * Get properties
     *
     *
     * @return array
     */
    public function getProperties()
    {
        return self::$properties;
    }

}