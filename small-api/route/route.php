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

VRoute::admin('sessions', 'session');

/**
 * 前台路由
 */
VRoute::home('sessions', 'session');


Route::miss('index/miss');