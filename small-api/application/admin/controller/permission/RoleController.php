<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller\permission;

use app\common\service\permission\RoleService;
use app\common\VController;

class RoleController extends VController
{
    public function index()
    {
        $service = new RoleService();
        $data = $service->getList();

        return $data;
    }

    public function create()
    {
        $service = new RoleService();
        $data = $service->createData($this->param);

        return $data;
    }

    public function update()
    {
        $service = new RoleService();
        $data = $service->updateData($this->param);

        return $data;
    }

    public function delete()
    {
        $service = new RoleService();
        $data = $service->deleteData($this->param['id']);

        return $data;
    }

    public function setPermission()
    {
        $service = new RoleService();
        $data = $service->setPermission($this->param);

        return $data;
    }
}