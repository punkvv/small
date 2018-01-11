<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\util\token;

use Firebase\JWT\JWT;

class Token
{

    public static function getBasePath()
    {
        return dirname(__FILE__).DIRECTORY_SEPARATOR;
    }

    public static function getPrivateKeyPath()
    {
        return self::getBasePath().'rsa_private_key.pem';
    }

    public static function getPublicKeyPath()
    {
        return self::getBasePath().'rsa_public_key.pem';
    }

    public static function create(array $token, int $exp)
    {
        $token['exp'] = time() + $exp;
        $privateKey = file_get_contents(self::getPrivateKeyPath());
        $jwt = JWT::encode($token, $privateKey, 'RS256');

        return $jwt;
    }

    public static function get($jwt)
    {
        try {
            $publicKey = file_get_contents(self::getPublicKeyPath());
            $decoded = JWT::decode($jwt, $publicKey, ['RS256']);

            return (array)$decoded;
        } catch (\Exception $exception) {
            return false;
        }
    }
}