<?php

/**
 * API 路由
 * Author: PunkVv <punkv@qq.com>
 */

use app\common\VRoute;
use think\facade\Route;

/**
 *  请先阅读 http://www.ruanyifeng.com/blog/2014/05/restful_api.html
 *  尽量遵循 restful 设计规范，并以以下顺序注册
 *  GET（SELECT）            从服务器取出资源(多项)。                        【返回资源对象的列表（数组）】
 *  GET（SELECT）/:id        从服务器取出资源（一项）。                      【返回单个资源对象】
 *  POST（CREATE）/:id       在服务器新建一个资源。                          【返回新生成的资源对象】
 *  PUT（UPDATE） /:id       在服务器更新资源（客户端提供改变后的完整资源）。【返回完整的资源对象】
 *  PATCH（UPDATE）/:id      在服务器更新资源（客户端提供改变的属性）。      【返回完整的资源对象】
 *  DELETE（DELETE）/:id     从服务器删除资源。                              【返回一个空文档】
 */

/**
 * 子路由使用 VRoute 注册，增加了一些额外参数,注意：客户端提交参数时不能再使用这些变量名
 * ['v_name' => '', 'v_log' => true, 'v_check' => false]
 * v_name:   路由名称
 * v_log:    是否记录操作日志（默认 false） 只对后台路由有效
 * v_check:  是否进行权限检测（默认 true）  只对后台路由有效
 */

/**
 * 后台路由
 */
Route::group('admin', function () {
    // 登录相关
    Route::group('login', function () {
        VRoute::rule(
            'login',
            'admin/permission.login/login',
            ['v_name' => '登录', 'v_log' => true, 'v_check' => false],
            'post');
    });
    // 用户相关
    Route::group('users', function () {
        VRoute::rule(
            'info',
            'admin/permission.user/info',
            ['v_name' => '获取登录用户信息', 'v_log' => false, 'v_check' => true],
            'get');
    });
    // 菜单相关
    Route::group('menus', function () {
        VRoute::rule(
            '',
            'admin/permission.menu/index',
            ['v_name' => '菜单列表', 'v_log' => false, 'v_check' => true],
            'get');
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
    VRoute::rule('error_logs', 'index/errorLog/index', ['v_name' => '错误日志列表'], 'get');
    VRoute::rule('error_logs/dynamic_count', 'index/errorLog/dynamicCount', ['v_name' => '获取未处理错误日志数量'], 'get');
    VRoute::rule('error_logs', 'index/errorLog/save', ['v_name' => '记录错误日志'], 'post');
})->allowCrossDomain();

Route::miss('index/miss');