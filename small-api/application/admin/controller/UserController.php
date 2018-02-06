<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\service\AdminUserService;
use app\common\VController;

class UserController extends VController
{
    public function info()
    {
        $service = new AdminUserService();
        $data = $service->getUserInfo($this->adminId($this->param['id']));

        return $data;
    }

    public function update()
    {
        $service = new AdminUserService();
        $data = $service->updateUser($this->adminId($this->param['id']), $this->param);

        return $data;
    }

    public function updatePassword()
    {
        $service = new AdminUserService();
        $data = $service->updatePassword($this->adminId($this->param['id']), $this->param);

        return $data;
    }
}