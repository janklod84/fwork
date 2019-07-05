<?php
namespace Project\Database;


use PDO;
use Project\Container\Singleton;
use R;



class DB
{

    use Singleton;


    /**
     * @var PDO $pdo
     * @var int $countSql  [ count of executed queries ]
     * @var array $queries
     */
    protected $pdo;
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


}