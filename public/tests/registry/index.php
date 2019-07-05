<?php

# http://work.loc/test/


// [ Configuration ]
$config = [
    'components' => [
        'cache' => 'classes\Cache',
        'test'  => 'classes\Test'
    ],

];


// [ Autoload classes ]
spl_autoload_register(function ($classname) {
    $file = str_replace('\\', '/', $classname). '.php';
    @require_once($file);
});




// Class Register [ Registry ]
class Registry
{
     public static $objects = [];
     protected static $instance;


     protected function __construct()
     {
         global $config;

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


# Instance of Registry
$app = Registry::instance();

# Magic method __get(name) {}
//$app->getList();
// print_r($app->test);
// $app->test->go();


# Magic method __set(name, $classname) {}
$app->hello = 'classes\Hello';

$app->getList();
$app->hello->friend(); # Bonjour
$app->hello->friend('Michelle'); # Bonjour, Michelle