<?php

namespace App\Model;

use Kernel\ModelBase\Model;

class Users extends Model
{
    protected $id;
    protected $nome;
    protected $email;
    protected static $cep;

    public function __construct()
    {
    }
}