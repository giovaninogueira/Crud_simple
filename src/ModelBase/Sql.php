<?php

namespace Kernel\ModelBase;

use Kernel\ModelBase\Interfaces\MakeSQL;

/**
 * Class Sql
 * @package Kernel\ModelBase
 */
abstract class Sql implements MakeSQL
{
    private $sql = '';
    private $attrs = [];

    /**
     * Sql constructor.
     */
    public function __construct()
    {
    }

    function insert()
    {
    }

    function select()
    {
    }

    function update()
    {
    }

    function delete()
    {
    }

    function where($name, $operator, $value, $continuos = null)
    {
    }
}