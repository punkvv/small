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
        $id = $this->param['id'];
        $service = new AdminUserService();
        $data = $service->getUserInfo($id);

        return $data;
    }
}