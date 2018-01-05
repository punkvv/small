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
    // 用户相关
    Route::group('user', function () {
        Route::post('login', 'admin/user/login'); // 登录
        Route::post('logout', 'admin/user/logout'); // 退出登录
        Route::get('info/:token', 'admin/user/info'); // 获取登录用户信息
    });
})->allowCrossDomain();

/**
 * 前台路由
 */
Route::group('v1', function () {

})->allowCrossDomain();

Route::miss('index/miss');