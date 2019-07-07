<?php
namespace app\models;


use Project\Database\Model;

/**
 * Class User
 *
 * @package app\models\User
 */
class User extends Model
{

     // Table name
     public $table = 'user';


     // Filable data
     public $attributes = [
         'login' => '',
         'password' => '',
         'email' => '',
         'name'  => '',
         // 'role'  => 'user'
     ];

     // Rules for validation data
     public $rules = [
         'required'  => [
             ['login'],
             ['password'],
             ['email'],
             ['name']
         ],
         'email'     => [
             ['email']
         ],
         'lengthMin' => [
             ['password', 6]
         ]
     ];


     // create method 'll verify if data UNIQUE
    // it used before save
    public function checkUnique()
    {
        $user = \R::findOne(
            $this->table, 'login = ? OR email = ? LIMIT 1', [
                $this->attributes['login'],
                $this->attributes['email']
        ]);

        // if has user with this email or login
        if($user)
        {
            // compare data
            if($user->login == $this->attributes['login'])
            {
                $this->errors['unique'][] = 'Этот логин уже занят';
            }

            if($user->email == $this->attributes['email'])
            {
                $this->errors['unique'][] = 'Этот e-майл уже занят';
            }

            return false;
        }

        return true;
    }


    /**
     * Login
     */
    public function login()
    {
       $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
       $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;

       if($login && $password)
       {
           $user = \R::findOne($this->table, 'login = ? LIMIT 1', [$login]);
           if($user)
           {
                if(password_verify($password, $user->password))
                {
                    foreach ($user as $key => $value)
                    {
                         /*
                           IDEA TO Implements
                           blackList = [], or guarded = []
                           if(in_array($key, $blackList)) { Do something ! }
                         */
                         if($key != 'password')
                         {
                             $_SESSION['user'][$key] = $value;
                         }
                    }
                    return true;
                }
           }
       }
       return false;
    }
}