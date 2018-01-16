<?php

/**
 * API 路由
 * Author: PunkVv <punkv@qq.com>
 */

use think\facade\Route;

/**
 * 尽量遵循 restful 设计规范，并以以下顺序注册
 *  'index'  => ['get', '', 'index'],
 *  'read'   => ['get', '/:id', 'read'],
 *  'save'   => ['post', '', 'save'],
 *  'update' => ['put', '/:id', 'update'],
 *  'delete' => ['delete', '/:id', 'delete'],
 */

/**
 * 后台路由
 */
Route::group('admin', function () {
    // 登录相关
    Route::group('login', function () {
        Route::rule('login', 'admin/permission.login/login', 'post'); // 登录
        Route::rule('logout', 'admin/permission.login/logout', 'post'); // 退出登录
    });
    // 用户相关
    Route::group('users', function () {
        Route::rule('/info', 'admin/permission.user/info', 'get'); // 获取登录用户信息
    });
    // 菜单相关
    Route::group('menus', function () {
        Route::rule('', 'admin/permission.menu/index', 'get'); // 获取菜单列表
    });
})->allowCrossDomain();

/**
 * 前台路由
 */
Route::group('v1', function () {

})->allowCrossDomain();

/**
 * 公共路由
 */
Route::group('index', function () {
    Route::rule('error_logs', 'index/errorLog/save', 'post'); // 记录错误日志
})->allowCrossDomain();

Route::miss('index/miss');