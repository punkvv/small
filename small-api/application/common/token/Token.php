<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\token;

use Firebase\JWT\JWT;

/**
 * Token 管理
 * Class Token
 * @package app\common
 */
class Token
{

    public static function create($value, $expire)
    {
        $token['exp'] = time() + $expire;
        $token['second'] = $expire;
        $basePath = dirname(__FILE__).DIRECTORY_SEPARATOR;
        $privatePath = "{$basePath}private_key.pem";
        $privateKey = openssl_pkey_get_private(file_get_contents($privatePath));
        $token = JWT::encode($value, $privateKey, 'RS256');

        return $token;
    }

    public static function refresh(string $key)
    {
        $value = static::get($key);
        $expire = $value['second'];
        $value['exp'] = time() + $expire;
        $token = static::create($value, $value);

        return $token;
    }

    public static function get(string $key)
    {
        try {
            $basePath = dirname(__FILE__).DIRECTORY_SEPARATOR;
            $publicPath = "{$basePath}public_key.pem";
            $publicKey = openssl_pkey_get_public(file_get_contents($publicPath));
            $decoded = (array)JWT::decode($key, $publicKey, ['RS256']);
        } catch (\Exception $exception) {
            $decoded = '';
        }

        return $decoded;
    }


    public static function validate(string $key)
    {
    }


    public static function remove(string $key)
    {
    }
}