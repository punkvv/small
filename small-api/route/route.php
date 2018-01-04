<?php

/**
 * API 路由
 * Author: PunkVv <punkv@qq.com>
 */

use app\common\VRoute;
use think\facade\Route;

/**
 * 后台路由
 */

// session 管理
VRoute::admin('sessions', 'session')->except(['index', 'update']);

/**
 * 前台路由
 */
VRoute::v1('sessions', 'session');


Route::miss('index/miss');