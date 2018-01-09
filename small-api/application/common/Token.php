<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\facade\Cache;

/**
 * Token 管理
 * Class Token
 * @package app\common
 */
class Token
{

    private static $key = 'Token';

    private static $token;

    public static function create(string $key, $value, $expire)
    {
        $key = md5($key.time());
        Cache::set(static::$key.$key, $value, $expire);
        static::$token = $key;

        return $key;
    }

    public static function getInfo(string $key)
    {
        $value = Cache::get(static::$key.$key);

        return $value;
    }

    public static function remove(string $key)
    {
        Cache::rm(static::$key.$key);
    }


    public static function setToken($token)
    {
        static::$token = $token;
    }

    public static function getToken()
    {
        return static::$token;
    }
}