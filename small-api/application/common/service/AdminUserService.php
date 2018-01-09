<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service;

use app\common\HttpCode;
use app\common\model\AdminUser;
use app\common\Token;
use app\common\VService;

class AdminUserService extends VService
{

    public function getUserInfo($id)
    {
        return $this->result();
    }
}