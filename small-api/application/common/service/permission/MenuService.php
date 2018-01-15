<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service\permission;

use app\common\model\permission\AdminMenu;
use app\common\VService;

class MenuService extends VService
{
    public function getList($param)
    {
        $this->data = AdminMenu::getAll($param);

        return $this->result();
    }
}