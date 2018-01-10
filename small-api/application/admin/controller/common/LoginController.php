<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller\common;

use app\common\service\common\LoginService;
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