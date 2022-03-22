<?php

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $id;
    public $name;
    public $firstname;
    public $lastname;
    public $role;
    public $email;
    public $password;
    public $status;
     
}