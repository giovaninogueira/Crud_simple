<?php

namespace Kernel\ModelBase;

use Kernel\ModelBase\Interfaces\Crud;
use Kernel\Database\Connection;

abstract class Controller implements Crud
{
    /**
     * Controller constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed|void
     */
    function save()
    {
        try {
            $con = Connection::connect();
        } catch (\Exception $e) {

        }
    }

    /**
     * @return mixed|void
     */
    function find()
    {
    }

    /**
     * @return mixed|void
     */
    function updateData()
    {
    }

    /**
     * @return mixed|void
     */
    function deleteData()
    {
    }

    /**
     * @param $sql
     * @return mixed|void
     */
    function sql($sql)
    {
    }
}