<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model;

use app\common\VModel;

class AdminUser extends VModel
{
    /**
     * 根据用户名获取用户信息
     * @param $username
     * @return array|null|\PDOStatement|string|\think\Model
     */
    public static function getInfoByName($username)
    {
        return static::field('username,password,status')
            ->where('username', $username)
            ->find();
    }
}