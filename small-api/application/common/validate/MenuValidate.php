<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\validate;

use think\Validate;

class MenuValidate extends Validate
{
    protected $rule = [
        'id' => ['require'],
        'menu_name' => ['require', 'max' => 20, 'unique:menu'],
        'name' => ['require', 'max' => 20, 'unique:menu'],
        // parent_id 不为空时候为 integer 类型
        'parent_id' => ['requireCallback:app\common\VValidate::requireEmpty', 'integer',],
    ];

    protected $message = [
        'id.require' => 'id 不能为空',
        'name.require' => '路由名称不能为空',
        'name.max' => '路由名称不能超过20个字符',
        'name.unique' => '路由名称已存在',
        'menu_name.require' => '菜单名称不能为空',
        'menu_name.max' => '菜单名称不能超过20个字符',
        'menu_name.unique' => '菜单名称已存在',
        'parent_id.integer' => 'parent_id 类型错误',
    ];

    protected $scene = [
        'create' => ['name', 'menu_name', 'parent_id'],
        'update' => ['id', 'name', 'menu_name', 'parent_id'],
    ];
}