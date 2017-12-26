<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\behavior;

use app\common\Controller;

/**
 * 权限检查
 * Class CheckAuth
 * @package app\admin\behavior
 */
class CheckAuth
{
    public function run($params)
    {
        $token = Controller::getToken();
    }
}