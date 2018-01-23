<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service\permission;

use app\common\model\permission\facade\AdminRole;
use app\common\VService;

class RoleService extends VService
{

    public function getList()
    {
        $this->data = AdminRole::getAll();

        return $this->result();
    }

    public function createData($param)
    {
        return $this->result();
    }

    public function updateData($param)
    {
        return $this->result();
    }

    public function deleteData($id)
    {
        return $this->result();
    }

    public function setPermission($param)
    {
        return $this->result();
    }
}