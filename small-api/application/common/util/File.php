<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\util;

class File
{
    public static function buildSaveName($path)
    {
        $path = rtrim($path, '/').'/';
        $saveName = date('Ymd').'/'.md5(microtime(true));
        $filename = $path.$saveName;

        // 检测目录
        if (false === static::checkPath(dirname($filename))) {
            return false;
        }

        return $saveName;
    }

    /**
     * 检查目录是否可写
     * @param  string $path 目录
     * @return boolean
     */
    public static function checkPath($path)
    {
        if (is_dir($path)) {
            return true;
        }

        if (mkdir($path, 0755, true)) {
            return true;
        } else {
            return false;
        }
    }
}