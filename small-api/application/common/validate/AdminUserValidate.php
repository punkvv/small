<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\validate;

use think\Validate;

class AdminUserValidate extends Validate
{
    protected $rule = [
        'id' => ['require'],
        'username' => ['require', 'max' => 10, 'unique:admin_user'],
        'pass' => ['require', 'max' => 20],
        'check_pass' => ['require', 'confirm' => 'pass'],
        'avatar' => ['max' => 100],
        'real_name' => ['max' => 20],
        'phone' => ['max' => 20],
        'email' => ['max' => 20],
    ];

    protected $message = [
        'id.require' => 'id 不能为空',
        'username.require' => '用户名不能为空',
        'username.max' => '用户名不能超过10个字符',
        'username.unique' => '用户名已存在',
        'pass.require' => '密码不能为空',
        'pass.max' => '密码不能超过20个字符',
        'check_pass.require' => '确认密码不能为空',
        'check_pass.confirm' => '两次输入密码不一致',
        'avatar.max' => '头像不能超过100个字符',
        'real_name.max' => '姓名不能超过20个字符',
        'phone.max' => '手机号码不能超过20个字符',
        'email.max' => '邮箱地址不能超过20个字符',
    ];

    protected $scene = [
        'create' => ['username', 'pass', 'check_pass', 'avatar', 'real_name', 'phone', 'email'],
        'update' => ['id', 'username', 'avatar', 'real_name', 'phone', 'email'],
        'changePass' => ['id', 'pass', 'check_pass'],
    ];
}