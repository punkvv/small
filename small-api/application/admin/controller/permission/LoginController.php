<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller\permission;

use app\common\service\permission\LoginService;
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