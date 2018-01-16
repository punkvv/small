<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\permission;

use app\common\VModel;

class AdminMenu extends VModel
{

    /**
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAll()
    {
        $query = $this->field('id,name,menu_name,parent_id,router')
            ->where('is_del', 1)->order('sort', 'desc');

        $items = $query->select();

        return $items;
    }

    /**
     * @param $adminId
     * @return mixed
     * @throws \think\db\exception\BindParamException
     * @throws \think\exception\PDOException
     */
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