<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\util;

class Encrypt
{
    /**
     * 生成加密串
     * @param string $str
     * @return bool|string
     */
    public static function generate(string $str)
    {
        $hash = password_hash($str, PASSWORD_BCRYPT);

        return $hash;
    }

    /**
     * 验证加密串
     * @param string $str
     * @param string $hash
     * @return bool
     */
    public static function validate(string $str, string $hash)
    {
        return password_verify($str, $hash);
    }
}