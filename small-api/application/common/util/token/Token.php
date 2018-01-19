<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\util\token;

use Firebase\JWT\JWT;

class Token
{

    public static function getBasePath(): string
    {
        return dirname(__FILE__).DIRECTORY_SEPARATOR;
    }

    public static function getPrivateKeyPath(): string
    {
        return self::getBasePath().'rsa_private_key.pem';
    }

    public static function getPublicKeyPath(): string
    {
        return self::getBasePath().'rsa_public_key.pem';
    }

    public static function create(array $token, int $exp): string
    {
        $token['exp'] = time() + $exp;
        $privateKey = file_get_contents(self::getPrivateKeyPath());
        $jwt = JWT::encode($token, $privateKey, 'RS256');

        return $jwt;
    }

    public static function get(string $jwt)
    {
        $publicKey = file_get_contents(self::getPublicKeyPath());
        $decoded = JWT::decode($jwt, $publicKey, ['RS256']);

        return (array)$decoded;

    }
}