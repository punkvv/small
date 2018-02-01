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
 *
 */

Route::group('admin', function () {
    // 上传相关
    Route::group('uploads', function () {
        VRoute::rule(
            'image',
            'admin/upload/image',
            ['v_name' => '上传图片', 'v_check' => false],
            'post');
    });

    // 错误日志相关
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
            ':id/change_status',
            'admin/errorLog/changeStatus',
            ['v_name' => '错误日志打开或处理'],
            'post');
        VRoute::rule(
            'change_status',
            'admin/errorLog/changeStatusAll',
            ['v_name' => '错误日志全部处理'],
            'post');
        VRoute::rule(
            'delete_all',
            'admin/errorLog/delete',
            ['v_name' => '错误日志全部删除'],
            'post');
    });

    // 操作日志相关
    Route::group('api_logs', function () {
        VRoute::rule(
            '',
            'admin/apiLog/index',
            ['v_name' => '操作日志列表', 'v_log' => false],
            'get');
    });

    // 登录相关
    Route::group('login', function () {
        VRoute::rule(
            'login_by_password',
            'admin/login/loginByPassword',
            ['v_name' => '用户密码登录', 'v_check' => false],
            'post');
    });

    // 个人相关
    Route::group('users', function () {
        VRoute::rule(
            ':id',
            'admin/user/info',
            ['v_name' => '获取个人信息', 'v_log' => false],
            'get');
        VRoute::rule(
            ':id',
            'admin/user/update',
            ['v_name' => '更新个人信息'],
            'put');
        VRoute::rule(
            ':id/update_password',
            'admin/user/updatePassword',
            ['v_name' => '更新个人密码'],
            'post');
    });

    // 用户相关
    Route::group('admin_users', function () {
        VRoute::rule(
            '',
            'admin/system.adminUser/index',
            ['v_name' => '用户列表', 'v_log' => false],
            'get');
        VRoute::rule(
            '',
            'admin/system.adminUser/create',
            ['v_name' => '创建用户'],
            'post');
        VRoute::rule(
            ':id',
            'admin/system.adminUser/update',
            ['v_name' => '更新用户'],
            'put');
        VRoute::rule(
            ':id',
            'admin/system.adminUser/delete',
            ['v_name' => '删除用户'],
            'delete');
        VRoute::rule(
            ':id/change_status',
            'admin/system.adminUser/changeStatus',
            ['v_name' => '用户禁用启用'],
            'post');
        VRoute::rule(
            ':id/change_password',
            'admin/system.adminUser/changePassword',
            ['v_name' => '修改用户密码'],
            'post');
        VRoute::rule(
            ':id/roles',
            'admin/system.adminUser/roles',
            ['v_name' => '获取用户角色', 'v_log' => false],
            'get');
        VRoute::rule(
            ':id/roles',
            'admin/system.adminUser/createRole',
            ['v_name' => '设置用户角色'],
            'post');
    });

    // 菜单相关
    Route::group('menus', function () {
        VRoute::rule(
            '',
            'admin/system.menu/index',
            ['v_name' => '菜单列表', 'v_log' => false],
            'get');
        VRoute::rule(
            '',
            'admin/system.menu/create',
            ['v_name' => '创建菜单'],
            'post');
        VRoute::rule(
            ':id',
            'admin/system.menu/update',
            ['v_name' => '更新菜单'],
            'put');
        VRoute::rule(
            ':id',
            'admin/system.menu/delete',
            ['v_name' => '删除菜单'],
            'delete');
    });

    // 角色相关
    Route::group('roles', function () {
        VRoute::rule(
            '',
            'admin/system.role/index',
            ['v_name' => '角色列表', 'v_log' => false],
            'get');
        VRoute::rule(
            '',
            'admin/system.role/create',
            ['v_name' => '创建角色'],
            'post');
        VRoute::rule(
            ':id',
            'admin/system.role/update',
            ['v_name' => '更新角色'],
            'put');
        VRoute::rule(
            ':id',
            'admin/system.role/delete',
            ['v_name' => '删除角色'],
            'delete');
        VRoute::rule(
            ':id/menus',
            'admin/system.role/menus',
            ['v_name' => '获取角色权限', 'v_log' => false],
            'get');
        VRoute::rule(
            ':id/menus',
            'admin/system.role/createMenu',
            ['v_name' => '设置角色权限'],
            'post');
    });
})->allowCrossDomain();