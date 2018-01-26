<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service\permission;

use app\common\model\permission\AdminRoleMenu;
use app\common\model\permission\facade\AdminMenu;
use app\common\model\permission\facade\AdminRole;
use app\common\VService;

class RoleService extends VService
{

    public function getList($param)
    {
        $this->data = AdminRole::getList($param);

        return $this->result();
    }

    public function createData($param)
    {
        if ($this->validate($param, 'role', 'create')) {
            $data = AdminRole::create([
                'role_name' => $param['role_name'],
                'remark' => $param['remark'],
            ]);
            $this->data = $data;
        }

        return $this->result();
    }

    public function updateData($param)
    {
        if ($this->validate($param, 'role', 'update')) {
            $data = AdminRole::update([
                'id' => $param['id'],
                'role_name' => $param['role_name'],
                'remark' => $param['remark'],
            ]);
            $this->data = $data;
        }

        return $this->result();
    }

    public function deleteData($id)
    {
        AdminRole::get($id)->delete();

        return $this->result();
    }

    public function getMenuList($id)
    {
        $this->data = AdminMenu::getListByRole($id);

        return $this->result();
    }

    public function createMenu($param)
    {
        $roleId = $param['id'];
        $items = $param['items'];
        $list = [];
        foreach ($items as $item) {
            $list[] = [
                'menu_id' => $item,
                'role_id' => $roleId,
            ];
        }
        AdminRoleMenu::where('role_id', $roleId)->delete();
        $adminRoleMenu = new AdminRoleMenu;
        $adminRoleMenu->saveAll($list);

        return $this->result();
    }
}