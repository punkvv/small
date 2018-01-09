<?php

/**
 * API 路由
 * Author: PunkVv <punkv@qq.com>
 */

use think\facade\Route;

/**
 * 尽量遵循 restful 设计规范，并以以下顺序注册
 *  'index'  => ['get', '', 'index'],
 *  'create' => ['get', '/create', 'create'],
 *  'edit'   => ['get', '/:id/edit', 'edit'],
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
        Route::rule('login', 'admin/login/login', 'post'); // 登录
        Route::rule('logout', 'admin/login/logout', 'post'); // 退出登录
    });
    // 用户相关
    Route::group('users', function () {
        Route::rule(':id', 'admin/user/info', 'get'); // 获取登录用户信息
    });
})->allowCrossDomain()->header('Access-Control-Allow-Headers',
    'Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With, V-Token');

/**
 * 前台路由
 */
Route::group('v1', function () {

})->allowCrossDomain();

Route::miss('index/miss');