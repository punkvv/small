<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\system;

use app\common\VModel;
use think\Db;

class Role extends VModel
{
    protected static function init()
    {
        // 删除后置操作
        self::afterDelete(function ($data) {
            AdminUserRole::where('role_id', $data->id)->delete();
            RoleMenu::where('role_id', $data->id)->delete();
        });
    }

    public function getList($param)
    {

        $query = $this->field('id,role_name,remark');
        if (!empty($param['role_name'])) {
            $query->whereLike('role_name', "%{$param['role_name']}%");
        }
        $query->order('id', 'desc');
        $data = $this->queryPaginate($query, $param);

        return $data;
    }

    public function getMenuList($roleId)
    {
        $list = Db::view('RoleMenu', 'menu_id')
            ->view('Menu', 'menu_name', 'RoleMenu.menu_id=Menu.id')
            ->where('RoleMenu.role_id', $roleId)
            ->select();

        return $list;
    }
}