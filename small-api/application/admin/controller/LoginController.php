<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\service\LoginService;
use app\common\VController;

class LoginController extends VController
{
    public function login()
    {
        $service = new LoginService();
        $data = $service->login($this->param);

        return $data;
    }

    public function logout()
    {

    }
}