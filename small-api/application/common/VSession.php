<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\facade\Cache;

/**
 * session 管理
 * Class VSession
 * @package app\common
 */
class VSession
{

    private static $key = 'Token';

    private static $token;

    public static function createToken(string $key, $value, $expire)
    {
        $key = md5($key.time());
        Cache::set(static::$key.$key, $value, $expire);
        static::$token = $key;

        return $key;
    }


    public static function setToken($token)
    {
        static::$token = $token;
    }

    public static function getToken()
    {
        return static::$token;
    }


    public static function removeToken()
    {
        Cache::rm(static::$key.static::$token);
    }

    public static function getInfo()
    {
        $value = Cache::get(static::$key.static::$token);

        return $value;
    }


    public static function getAdminId()
    {
        $info = static::getInfo();

        return $info['id'];
    }
}