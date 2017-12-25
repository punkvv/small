<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service;

use app\common\Service;

class AdminUserService extends Service
{
    /**
     * 登录
     * @param string $loginName
     * @param string $password
     * @return array
     */
    public function login(string $loginName, string $password)
    {
        return $this->returnData();
    }
}