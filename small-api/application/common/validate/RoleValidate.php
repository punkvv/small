<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\validate;

use think\Validate;

class RoleValidate extends Validate
{
    protected $rule = [
        'id' => ['require'],
        'role_name' => ['require', 'max' => 20, 'unique:admin_role'],
        'remark' => ['max' => 255],
    ];

    protected $message = [
        'id.require' => 'id 不能为空',
        'role_name.require' => '角色名称不能为空',
        'role_name.max' => '角色名称不能超过20个字符',
        'role_name.unique' => '角色名称已存在',
        'remark.max' => '备注不能超过255个字符',
    ];

    protected $scene = [
        'create' => ['role_name', 'remark'],
        'update' => ['id', 'role_name', 'remark'],
    ];
}