<?php

namespace Kernel\ModelBase;

/**
 * Class Model
 */
abstract class Model
{
    /**
     * Model constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param callable $fn
     */
    public function __invoke(callable $fn)
    {
        $fn();
    }

    /**
     * @param $obj
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