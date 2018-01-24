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
        });
    }

    public function getList($param)
    {
        $where = '';
        $bind = [];
        if (!empty($param['role_name'])) {
            $where .= ' AND role_name LIKE :role_name';
            $bind['role_name'] = $this->like($param['role_name']);
        }

        $page = $this->getPage($param);
        $select = 'SELECT id,role_name,remark';
        $from = 'FROM t_admin_role WHERE 1=1'.$where.' ORDER BY id DESC';
        $data = $this->nativePaginate($select, $from, $page, $bind);

        return $data;
    }
}