<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\system;

use app\common\VModel;
use think\Db;

class Menu extends VModel
{
    protected static function init()
    {
        // 删除后置操作
        self::afterDelete(function ($data) {
            // 把中间表数据清空
            RoleMenu::where('menu_id', $data->id)->delete();
            // 把子类清空
            Menu::where('parent_id', $data->id)->delete();
        });
    }

    public function getList()
    {
        $items = $this->field('id,name,menu_name,parent_id,router')
            ->order('id')->select();

        return $items;
    }

    public function getListByAdminId($adminId)
    {
        $list = Db::view('AdminMenu', 'id,name,menu_name,parent_id,parent_name,router')
            ->view('AdminRoleMenu', 'menu_id', 'AdminMenu.id=AdminRoleMenu.menu_id')
            ->view('AdminUserRole', 'role_id', 'AdminRoleMenu.role_id=AdminUserRole.role_id')
            ->where('AdminUserRole.admin_id', $adminId)
            ->select();

        return $list;
    }

    public function getListByRole($roleId)
    {
        $list = Db::view('AdminRoleMenu', 'menu_id')
            ->view('AdminMenu', 'menu_name', 'AdminRoleMenu.menu_id=AdminMenu.id')
            ->where('AdminRoleMenu.role_id', $roleId)
            ->select();

        return $list;
    }
}