<?php
namespace Project\Database;



use Exception;
use Valitron\Validator;
use R;


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
     * Ex:
     *  Localisation : Can set own language directory
     *   V::langDir(__DIR__.'/validator_lang') // directory
     *   V::lang('ru')
     *
     * @link https://packagist.org/packages/vlucas/valitron
     * @param array $data
     * @return bool
     */
    public function validate($data)
    {
        Validator::langDir(WWW.'/valitron/lang');
        Validator::lang('ru');
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
     * Save data
     *
     * @return int|string
     */
    public function save()
    {
        if(!$this->table)
        {
            throw new Exception('Table name does not setted inside class [ ' . get_class($this) . ' ]');
        }

        $tbl = R::dispense($this->table);
        foreach ($this->attributes as $name => $value)
        {
             $tbl->{$name} = $value;
        }

        return R::store($tbl);
    }


    /**
     * Get Errors
     *
     * @return array
     */
    public function getErrors()
    {
        /* return $this->errors; */
        $errors = '<ul>';
        foreach ($this->errors as $error)
        {
            foreach ($error as $item)
            {
                $errors .= sprintf('<li>%s</li>', $item);
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
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