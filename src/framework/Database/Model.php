<?php
namespace Project\Database;



use Valitron\Validator;



abstract class Model
{


    /**
     * @var PDO $pdo
     * @var string $table
     * @var string $pk
     * @var array $attributes [ Fillable data]
     * @var array $errors
     * @var array $rules
     */
    protected $pdo;
    protected $table;
    protected $pk = 'id';
    public $attributes = [];
    public $errors = [];
    public $rules  = [];



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
     * Load data [ Array table ex : From anywhere $_POST  ]
     * [ Assign attributes by key and value ]
     *
     *
     * @param array $data
     * @return
     */
    public function load($data)
    {
       foreach($this->attributes as $name => $value)
       {
           if(isset($data[$name]))
           {
               $this->attributes[$name] = $data[$name];
           }
       }
    }


    /**
     * Validate data
     *
     * @link https://packagist.org/packages/vlucas/valitron
     * @param array $data
     */
    public function validate($data)
    {
        $v = new Validator($data);
        $v->rules($this->rules);

        if($v->validate())
        {
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }


    /**
     * Get Errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
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