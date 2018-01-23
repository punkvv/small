<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\permission;

use app\common\VModel;

class AdminMenu extends VModel
{

    public function getAll()
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

}