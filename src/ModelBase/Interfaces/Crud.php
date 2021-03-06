<?php

namespace Kernel\ModelBase\Interfaces;

/**
 * Interface Crud
 */
interface Crud
{
    /**
     * @return mixed
     */
    public function save();

    /**
     * @return mixed
     */
    public function deleteData();

    /**
     * @return mixed
     */
    public function updateData();

    /**
     * @return mixed
     */
    public function find();

    /**
     * @param $sql
     * @return mixed
     */
    public function sql($sql);
}