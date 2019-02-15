<?php

namespace App\Controller;

use App\Model\Users;

/**
 * Class UsersController
 * @package App\Controller
 */
class UsersController
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
    }

    public function insert()
    {
        try {
            $users = new Users();
            $users->id = 1;
            $users->nome = 'Giovani';
            $users->email = 'pp@gmail.com';
            $users->save();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}