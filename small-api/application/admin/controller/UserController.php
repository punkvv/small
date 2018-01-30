<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\service\permission\AdminUserService;
use app\common\VController;

class UserController extends VController
{
    public function info()
    {
        $service = new AdminUserService();
        $data = $service->getUserInfo($this->adminId(true));

        return $data;
    }
}