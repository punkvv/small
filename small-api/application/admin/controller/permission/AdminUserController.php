<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller\permission;

use app\common\service\permission\AdminUserService;
use app\common\VController;

class AdminUserController extends VController
{
    public function index()
    {
        $service = new AdminUserService();
        $data = $service->getList($this->param);

        return $data;
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function changeStatus()
    {

    }

    public function changePassword()
    {

    }

    public function roles()
    {

    }

    public function createRole()
    {

    }
}