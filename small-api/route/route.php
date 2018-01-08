<?php

/**
 * API 路由
 * Author: PunkVv <punkv@qq.com>
 */

use think\facade\Route;

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
    Route::group('user', function () {
        Route::rule('info/:token', 'admin/user/info', 'get'); // 获取登录用户信息
    });
})->allowCrossDomain()->header('Access-Control-Allow-Headers', 'V-Token');

/**
 * 前台路由
 */
Route::group('v1', function () {

})->allowCrossDomain();

Route::miss('index/miss');