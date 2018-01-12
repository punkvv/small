<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\common;

use app\common\VModel;

class AdminUser extends VModel
{

    public static function getInfoByName($username)
    {
        return static::field('id,username,password,status')
            ->where('username', $username)
            ->find();
    }

    public static function getInfoById($userId)
    {
        return static::field('id,username,avatar')->where('id', $userId)->find();
    }
}