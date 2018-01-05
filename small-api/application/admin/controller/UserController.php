<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\service\AdminUserService;
use app\common\VController;

class UserController extends VController
{
    public function login()
    {
        $service = new AdminUserService();
        $data = $service->login($this->param);

        return $data;
    }

    public function logout()
    {

    }

    public function info()
    {

    }
}