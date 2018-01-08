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
        $token = $this->param['token'];
        $service = new AdminUserService();
        $data = $service->getUserInfo($token);

        return $data;
    }
}