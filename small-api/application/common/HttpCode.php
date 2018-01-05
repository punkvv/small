<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

/**
 * 返回 code
 * Class HttpCode
 * @package app\common
 */
class HttpCode
{
    /**
     * 请求成功
     * @var int
     */
    public static $success = 2000;

    /**
     * token 过期
     * @var int
     */
    public static $tokenOut = 3000;

    /**
     * 系统异常
     * @var int
     */
    public static $exception = 4000;
}