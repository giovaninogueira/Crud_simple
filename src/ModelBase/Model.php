<?php

namespace Kernel\ModelBase;

use Kernel\ModelBase\Controller;

/**
 * Class Model
 */
abstract class Model extends Controller
{

    /**
     * @param callable $fn
     */
    public function __invoke(callable $fn)
    {
        $fn();
    }

    /**
     * @param $obj
     * @return $this
     * @throws \ReflectionException
     */
    public function setObj($obj)
    {
        $json = json_decode($obj);
        if($json && !is_array($obj)) {
            $param = $json;
        } else {
            $param = (array) $obj;
        }
        $reflection = new \ReflectionClass(static::class);
        foreach ($param as $name => $vl) {
            $ppr = $reflection->getProperty($name);
            if($ppr->isStatic()) {
                $ppr->setAccessible(true);
                $ppr->setValue($vl);
            } else {
                $this->{$name} = $vl;
            }
        }
        return $this;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if(property_exists(static::class, $name)) {
            $this->{$name} = $value;
        } else {
            trigger_error("Fatal error", E_USER_ERROR);
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if(property_exists(static::class, $name)) {
            return $this->{$name};
        } else {
            trigger_error("Fatal error", E_USER_ERROR);
        }
    }
}