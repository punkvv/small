<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\permission;

use app\common\VModel;

class AdminMenu extends VModel
{
    protected static function init()
    {
        // 删除后置操作
        self::afterDelete(function ($data) {
            AdminRoleMenu::where('menu_id', $data->id)->delete();
        });
    }

    public function getList()
    {
        $items = $this->field('id,name,menu_name,parent_id,router')
            ->order('sort', 'desc')->select();

        return $items;
    }

    public function getListByAdminId($adminId)
    {
        $sql = 'SELECT a.id,a.name,a.menu_name,a.parent_id,a.router 
                FROM t_admin_menu AS a INNER JOIN t_admin_role_menu AS b ON a.id=b.menu_id
                INNER JOIN t_admin_user_role AS c ON b.role_id=c.role_id
                WHERE c.admin_id=:admin_id';

        $items = $this->query($sql, ['admin_id' => $adminId]);

        return $items;
    }

    public function getListByRole($roleId)
    {
        $sql = 'SELECT a.menu_id,b.menu_name 
                FROM t_admin_role_menu AS a INNER JOIN t_admin_menu AS b ON a.menu_id=b.id
                WHERE a.role_id=:role_id';

        $items = $this->query($sql, ['role_id' => $roleId]);

        return $items;
    }
}