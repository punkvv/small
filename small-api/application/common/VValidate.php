<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

class VValidate
{
    public static function requireEmpty($value, $data)
    {
        if (!empty($value)) {
            return true;
        }

        return false;
    }
}