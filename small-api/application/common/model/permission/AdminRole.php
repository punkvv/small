<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\permission;

use app\common\VModel;

class AdminRole extends VModel
{
    public function getAll()
    {
        $items = $this->field('id,role_name,remark,menu_list')
            ->where('is_del', 1)
            ->order('id', 'desc')->select();

        return $items;
    }
}