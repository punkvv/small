<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\validate;

use think\Validate;

class MenuValidate extends Validate
{
    protected $rule = [
        'menu_name' => ['require', 'max' => 10, 'unique:admin_menu'],
        'name' => ['require', 'max' => 10, 'unique:admin_menu'],
        // parent_id 不为空时候为 integer 类型
        'parent_id' => ['requireCallback:app\common\VValidate::requireEmpty', 'integer',],
    ];

    protected $message = [
        'name.require' => 'name 不能为空',
        'name.max' => 'name 不能超过10个字符',
        'name.unique' => '路由名称已存在',
        'menu_name.require' => 'menu_name 不能为空',
        'menu_name.max' => 'menu_name 不能超过10个字符',
        'menu_name.unique' => '菜单名称已存在',
        'parent_id.integer' => 'parent_id 类型错误',
    ];

    protected $scene = [
        'create' => ['name', 'menu_name', 'parent_id'],
        'update' => ['name', 'menu_name', 'parent_id'],
    ];
}