<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

class Param
{
    protected $container = [];

    public function __set($name, $value)
    {
        $this->container[$name] = $value;
    }

    public function __get($name)
    {
        return $this->container[$name];
    }
}