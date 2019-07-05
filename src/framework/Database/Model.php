<?php
namespace Project\Database;



abstract class Model
{


    /**
     * @var PDO $pdo
     * @var string $table
     * @var string $pk
     */
    protected $pdo;
    protected $table;
    protected $pk = 'id';


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
     * Get name of table
     *
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
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


    /**
     * Find one record
     *
     *
     * @param $id
     * @param $field
     * @return array
     */
    public function findOne($id, $field='')
    {
        $field = $field ?: $this->pk;
        $sql = sprintf('SELECT * FROM `%s` WHERE %s = ? LIMIT 1', $this->table, $field);
        return $this->pdo->query($sql, [$id]);
    }


    /**
     * Find result by SQL
     *
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function findBySql($sql, $params = [])
    {
         return $this->pdo->query($sql, $params);
    }


    /**
     * Find result where LIKE %search%
     *
     *
     * @param $str
     * @param $field
     * @param string $table
     */
    public function findLike($str, $field, $table='')
    {
        $table = $table ?: $this->table;
        $sql = sprintf('SELECT * FROM `%s` WHERE %s LIKE ?', $table, $field);
        return $this->pdo->query($sql, ['%'. $str . '%']);
    }
}