<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\service\LoginService;
use app\common\VController;

class LoginController extends VController
{
    public function loginByPassword()
    {
        $service = new LoginService();
        $data = $service->loginByPassword($this->param);

        return $data;
    }
}