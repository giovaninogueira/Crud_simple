<?php

namespace App\Model;

use Kernel\ModelBase\Model;

/**
 * Class Users
 * @package App\Model
 */
class Users extends Model
{
    protected $id;
    protected $nome;
    protected $email;
    protected static $cep;

    /**
     * Users constructor.
     */
    public function __construct()
    {
    }
}