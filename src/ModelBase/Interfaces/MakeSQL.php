<?php

namespace Kernel\ModelBase\Interfaces;

interface MakeSQL
{
    /**
     * @return mixed
     */
    public function insert();

    /**
     * @return mixed
     */
    public function update();

    /**
     * @return mixed
     */
    public function select();

    /**
     * @return mixed
     */
    public function delete();

    /**
     * @return mixed
     */
    public function where($name, $operator, $value, $continuos = null);
}