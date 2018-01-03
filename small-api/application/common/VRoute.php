<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\facade\Route;

class VRoute
{

    public static function admin(string $rule, string $route, array $option = [], array $pattern = [])
    {
        return static::resource('admin', $rule, $route, $option, $pattern);
    }

    public static function home(string $rule, string $route, array $option = [], array $pattern = [])
    {
        return static::resource('home', $rule, $route, $option, $pattern);
    }


    /**
     * 注册资源路由
     * @access public
     * @param  string $rule 路由规则
     * @param  string $route 路由地址
     * @param  array $option 路由参数
     * @param  array $pattern 变量规则
     * @param string $model 模块名称
     * @return \think\route\Resource
     */
    private static function resource(
        string $model,
        string $rule,
        string $route,
        array $option = [],
        array $pattern = []
    ) {
        $model = $model.'/';

        return Route::resource($model.$rule, $model.$route, $option, $pattern)->except(['create', 'edit']);
    }
}