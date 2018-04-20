<?php

namespace CRUD\Control\Interfaces;
/**
 * Interface InterfaceCRUD
 */
interface InterfaceCRUD
{
    /**
     * @param $post
     * @return mixed
     */
    public function create($post);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $put
     * @return mixed
     */
    public function update($put, $id);

    /**
     * @param null $id
     * @return mixed
     */
    public function read($id = null);
}