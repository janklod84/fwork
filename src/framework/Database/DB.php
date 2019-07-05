<?php
namespace Project\Database;


use PDO;
use R;



class DB
{

    /**
     * @var PDO $pdo
     * @var object $instance
     * @var int $countSql  [ count of executed queries ]
     * @var array $queries
     */
    protected $pdo;
    protected static $instance;
    public static $countSql = 0;
    public static $queries = [];


    /**
     * DB constructor.
     *
     * @return void
     */
    protected function __construct()
    {
        # require readBeanPHP
        require LIBS .'/rb.php';

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
        // R::fancyDebug(true);
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

}