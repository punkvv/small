<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service\permission;

use app\common\model\permission\facade\AdminMenu;
use app\common\util\Tree;
use app\common\validate\MenuValidate;
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

    public function createData($param)
    {
        $validate = new MenuValidate();
        if ($this->validate($param, $validate, 'create')) {
            $data = [
                'name' => $param['name'],
                'menu_name' => $param['menu_name'],
                'parent_id' => empty($param['parent_id']) ? null : intval($param['parent_id']),
                'router' => $param['router'],
            ];
            AdminMenu::save($data);
            $data['id'] = AdminMenu::getLastInsID();

            $this->data = $data;
        }

        return $this->result();
    }

    public function countFiled($filed, $val)
    {
        $this->data['count'] = AdminMenu::where($filed, $val)->count();

        return $this->result();
    }

}