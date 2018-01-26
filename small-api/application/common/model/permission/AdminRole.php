<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\permission;

use app\common\VModel;

class AdminRole extends VModel
{
    protected static function init()
    {
        // 删除后置操作
        self::afterDelete(function ($data) {
            AdminUserRole::where('role_id', $data->id)->delete();
            AdminRoleMenu::where('role_id', $data->id)->delete();
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
}