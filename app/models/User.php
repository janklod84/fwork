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
}