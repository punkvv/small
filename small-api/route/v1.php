<?php

/*
 * 前台路由
 * Author: PunkVv <punkv@qq.com>
 */


use think\facade\Route;

Route::group('v1', function () {

})->allowCrossDomain();

Route::miss('v1/miss/index');