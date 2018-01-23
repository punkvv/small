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
            $data = AdminMenu::create([
                'name' => $param['name'],
                'menu_name' => $param['menu_name'],
                'parent_id' => $param['parent_id'],
                'router' => $param['router'],
            ]);
            $this->data = $data;
        }

        return $this->result();
    }

    public function updateData($param)
    {
        $validate = new MenuValidate();
        if ($this->validate($param, $validate, 'update')) {
            $data = AdminMenu::update([
                'id' => $param['id'],
                'name' => $param['name'],
                'menu_name' => $param['menu_name'],
                'parent_id' => $param['parent_id'],
                'router' => $param['router'],
            ]);
            $this->data = $data;
        }

        return $this->result();
    }

    public function deleteData($id)
    {
        $data = AdminMenu::get($id);
        $data->delete();

        return $this->result();
    }

    public function countFiled($param)
    {
        $filed = $param['filed'];
        $val = $param['value'];
        $id = $param['id'];
        $query = AdminMenu::where($filed, $val);
        if ($id) {
            $query->where('id', '<>', $id);
        }
        $this->data['count'] = $query->count();

        return $this->result();
    }

}