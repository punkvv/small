<?php

/**
 * API 路由
 * Author: PunkVv <punkv@qq.com>
 */

use think\facade\Route;

// 后台路由
Route::group('admin', function () {
    Route::post('sessions', 'admin/session/save'); // 登录
    Route::get('sessions/:token', 'admin/session/read'); // 获取登录用户信息
    Route::delete('sessions/:token', 'admin/session/delete'); // 注销
});

Route::miss('index/miss');