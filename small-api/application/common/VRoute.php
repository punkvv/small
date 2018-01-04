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

    public function adminRule(
        string $rule,
        string $route,
        string $method = '*',
        array $option = [],
        array $pattern = []
    ) {
        return static::rule('admin', $rule, $route, $method, $option, $pattern);
    }

    public static function v1(string $rule, string $route, array $option = [], array $pattern = [])
    {
        return static::resource('v1', $rule, $route, $option, $pattern);
    }

    public function v1Rule(
        string $rule,
        string $route,
        string $method = '*',
        array $option = [],
        array $pattern = []
    ) {
        return static::rule('v1', $rule, $route, $method, $option, $pattern);
    }

    public static function rule(
        string $model,
        string $rule,
        string $route,
        string $method = '*',
        array $option = [],
        array $pattern = []
    ) {
        $model = $model.'/';

        return Route::rule($model.$rule, $model.$route, $method, $option, $pattern)->allowCrossDomain();
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

        return Route::resource($model.$rule, $model.$route, $option, $pattern)->except([
            'create',
            'edit',
        ])->allowCrossDomain();
    }
}