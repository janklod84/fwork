<?php
namespace Project\Database;



abstract class Model
{


    /**
     * @var PDO $pdo
     * @var string $table
     */
    protected $pdo;
    protected $table;


    /**
     * Model constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pdo = DB::instance();
    }


    /**
     * Execute Query
     *
     *
     * @param $sql
     * @return bool
     */
    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }


    /**
     * Return results of query
     *
     *
     * @return array
     */
    public function findAll()
    {
        $sql = sprintf('SELECT * FROM `%s`', $this->table);
        return $this->pdo->query($sql);
    }
}