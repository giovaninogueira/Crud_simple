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
    public function insert();

    /**
     * @return mixed
     */
    public function delete();

    /**
     * @return mixed
     */
    public function update();

    /**
     * @return mixed
     */
    public function select();
}