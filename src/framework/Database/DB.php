<?php
namespace Project\Database;


use PDO;

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
        $db = require ROOT . '/config/db.php';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $this->pdo = new PDO($db['dsn'], $db['user'], $db['pass'], $options);
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


    /**
     * Execute SQL query
     *
     *
     * @param string $sql
     * @param array  $params
     * @return bool
     */
    public function execute($sql, $params = [])
    {
        # execute query
        $stmt = $this->pdo->prepare($sql);
        if($executed = $stmt->execute($params))
        {
            self::addQuery($sql);
            return $executed;
        }
    }


    /**
     * Execute Query and return results
     *
     * @param string $sql
     * @param array  $params
     * @return array
     */
    public function query($sql, $params = [])
    {
        # execute query
        $stmt = $this->pdo->prepare($sql);
        $res  = $stmt->execute($params);
        if($res !== false)
        {
            self::addQuery($sql);
            return $stmt->fetchAll();
        }
        return [];
    }


    /**
     * Add Query
     *
     * @param $sql
     */
    public  static function addQuery($sql)
    {
        # increment count query
        self::$countSql++;

        # add queries
        self::$queries[] = $sql;

    }
}