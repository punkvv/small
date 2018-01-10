<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller\common;

use app\common\service\common\AdminUserService;
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