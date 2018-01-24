<?php

/**
 * 后台路由
 * Author: PunkVv <punkv@qq.com>
 */

use app\common\VRoute;
use think\facade\Route;

/**
 *  请先阅读 http://www.ruanyifeng.com/blog/2014/05/restful_api.html
 *  尽量遵循 restful 设计规范，并以以下顺序注册
 *  GET（SELECT）            从服务器取出资源(多项)。                        【返回资源对象的列表（数组）】
 *  GET（SELECT）/:id        从服务器取出资源（一项）。                      【返回单个资源对象】
 *  POST（CREATE）           在服务器新建一个资源。                          【返回新生成的资源对象】
 *  PUT（UPDATE） /:id       在服务器更新资源（客户端提供改变后的完整资源）。【返回完整的资源对象】
 *  PATCH（UPDATE）/:id      在服务器更新资源（客户端提供改变的属性）。      【返回完整的资源对象】
 *  DELETE（DELETE）/:id     从服务器删除资源。                              【返回一个空文档】
 *
 *  其它特殊路由全部用 POST
 */

/**
 * 子路由使用 VRoute 注册，增加了一些额外参数,注意：客户端提交参数时不能再使用这些变量名
 * ['v_name' => '', 'v_log' => true, 'v_check' => false]
 * v_name:   路由名称
 * v_check:  是否进行权限检测（默认 true）  只对后台路由有效
 * v_log:    是否记录操作日志（默认 true） v_check = true 时才有效
 */

Route::group('admin', function () {
    // 日志相关
    Route::group('error_logs', function () {
        VRoute::rule(
            '',
            'admin/errorLog/index',
            ['v_name' => '错误日志列表', 'v_log' => false],
            'get');
        VRoute::rule(
            'dynamic_count',
            'admin/errorLog/dynamicCount',
            ['v_name' => '获取未处理错误日志数量', 'v_log' => false],
            'get');
        VRoute::rule(
            '',
            'admin/errorLog/save',
            ['v_name' => '记录错误日志', 'v_check' => false],
            'post');
        VRoute::rule(
            '/change_status',
            'admin/errorLog/changeStatus',
            ['v_name' => '错误日志打开或处理'],
            'post');
        VRoute::rule(
            '/change_status_all',
            'admin/errorLog/changeStatusAll',
            ['v_name' => '错误日志全部处理'],
            'post');
        VRoute::rule(
            '/delete_all',
            'admin/errorLog/deleteAll',
            ['v_name' => '错误日志全部删除'],
            'post');
    });

    // 登录相关
    Route::group('login', function () {
        VRoute::rule(
            'login_by_password',
            'admin/login/loginByPassword',
            ['v_name' => '用户密码登录', 'v_check' => false],
            'post');
    });

    // 用户相关
    Route::group('users', function () {
        VRoute::rule(
            'info',
            'admin/permission.user/info',
            ['v_name' => '获取登录用户信息', 'v_log' => false],
            'get');
    });

    // 菜单相关
    Route::group('menus', function () {
        VRoute::rule(
            '',
            'admin/permission.menu/index',
            ['v_name' => '菜单列表', 'v_log' => false],
            'get');
        VRoute::rule(
            '',
            'admin/permission.menu/create',
            ['v_name' => '创建菜单'],
            'post');
        VRoute::rule(
            '/:id',
            'admin/permission.menu/update',
            ['v_name' => '更新菜单'],
            'put');
        VRoute::rule(
            '/:id',
            'admin/permission.menu/delete',
            ['v_name' => '删除菜单'],
            'delete');
    });

    // 角色相关
    Route::group('roles', function () {
        VRoute::rule(
            '',
            'admin/permission.role/index',
            ['v_name' => '角色列表', 'v_log' => false],
            'get');
        VRoute::rule(
            '',
            'admin/permission.role/create',
            ['v_name' => '创建角色'],
            'post');
        VRoute::rule(
            '/:id',
            'admin/permission.role/update',
            ['v_name' => '更新角色'],
            'put');
        VRoute::rule(
            '/:id',
            'admin/permission.role/delete',
            ['v_name' => '删除角色'],
            'delete');
        VRoute::rule(
            '/:id/menus',
            'admin/permission.role/indexMenu',
            ['v_name' => '获取角色权限', 'v_log' => false],
            'get');
        VRoute::rule(
            '/:id/menus',
            'admin/permission.role/createMenu',
            ['v_name' => '设置角色权限'],
            'post');
    });
})->allowCrossDomain();