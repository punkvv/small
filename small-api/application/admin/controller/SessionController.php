<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\Controller;
use app\common\service\AdminUserService;

class SessionController extends Controller
{

    public function save()
    {
        $service = new AdminUserService();
        $result = $service->login($this->param['login_name'], $this->param['password']);

        return $result;
    }

    public function read()
    {
        $service = new AdminUserService();

    }

    public function delete()
    {

    }
}