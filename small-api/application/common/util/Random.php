<?php

/**
 * User: PunkVv <punkv@qq.com>
 */

namespace app\common\util;

class Random
{
    /**
     * 生成随机数
     * @param $length
     * @return string
     */
    public static function number($length = 6)
    {
        $chars = "0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }

        return $str;
    }

    /**
     * 生成唯一编号
     * @param null $str
     * @return string
     */
    public static function code($str = null)
    {
        $strO = '';
        if ($str) {
            $strO = strlen($str) >= 9 ? substr($str, -9) : substr('000000000', 0, 9 - strlen($str)).$str;
        }
        $orderSn = date('Y').strtoupper(dechex(date('m'))).date('d').substr(time(), -5).substr(microtime(), 2,
                5).sprintf('%02d', rand(0, 99));

        return $orderSn.$strO;
    }
}