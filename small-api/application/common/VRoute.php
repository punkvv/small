<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\facade\Route;

class VRoute
{
    public static function rule(
        string $rule,
        string $route,
        array $param,
        string $method = '*',
        array $option = [],
        array $pattern = []
    ) {
        $paramStr = '?';
        foreach ($param as $key => $value) {
            $paramStr .= $key.'='.$value.'&';
        }
        $paramStr = substr($paramStr, 0, -1);
        Route::rule($rule, $route.$paramStr, $method, $option, $pattern);
    }
}