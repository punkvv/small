<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\service\RoleService;
use app\common\VController;

class RoleController extends VController
{
    public function index()
    {
        $service = new RoleService();
        $data = $service->getList($this->param);

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

    public function menus()
    {
        $service = new RoleService();
        $data = $service->getMenuList($this->param['id']);

        return $data;
    }

    public function createMenu()
    {
        $service = new RoleService();
        $data = $service->createMenu($this->param);

        return $data;
    }
}