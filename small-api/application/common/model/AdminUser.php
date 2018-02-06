<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model;

use app\common\VModel;
use think\Db;

class AdminUser extends VModel
{

    public static function getInfoByName($username)
    {
        $data = static::field('id,username,password,status')
            ->where('username', $username)
            ->find();

        return $data;
    }

    public static function getInfoById($userId)
    {
        $data = static::field('id,username,avatar,real_name,phone,email')->where('id', $userId)->find();

        return $data;
    }

    public static function getList($param)
    {
        $query = static::field('id,username,avatar,status,real_name,phone,email')
            ->where('is_del', 1)
            ->where('id', '<>', 1)
            ->order('id', 'desc');
        if (!empty($param['name'])) {
            $query->whereLike('username|real_name|phone', "%{$param['name']}%");
        }
        if (!empty($param['status'])) {
            $query->where('status', $param['status']);
        }
        $data = static::queryPaginate($query, $param);

        return $data;
    }

    public static function getMenuList($adminId)
    {
        $list = Db::view('Menu', 'id,name,menu_name,parent_id,parent_name,router')
            ->view('RoleMenu', 'menu_id', 'Menu.id=RoleMenu.menu_id')
            ->view('AdminUserRole', 'role_id', 'RoleMenu.role_id=AdminUserRole.role_id')
            ->where('AdminUserRole.admin_id', $adminId)
            ->select();

        return $list;
    }

    public static function getRoleList($id)
    {
        $list = Db::view('Role', 'role_name,remark')
            ->view('AdminUserRole', ['role_id' => 'id'], 'Role.id=AdminUserRole.role_id')
            ->where('AdminUserRole.admin_id', $id)
            ->select();

        return $list;
    }
}