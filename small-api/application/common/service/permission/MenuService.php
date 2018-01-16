<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service\permission;

use app\common\model\permission\facade\AdminMenu;
use app\common\util\Tree;
use app\common\VService;

class MenuService extends VService
{
    public function getList()
    {
        $items = AdminMenu::getAll();

        // 组合成树结构
        $this->data = Tree::listToTree($items->toArray(), 'id', 'parent_id');

        return $this->result();
    }
}