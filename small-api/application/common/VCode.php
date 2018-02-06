<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

/**
 * 返回 code
 * Class VCode
 * @package app\common
 */
class VCode
{
    /**
     * 请求成功
     * @var int
     */
    public static $ok = 200;

    /**
     * 请求有误
     * @var int
     */
    public static $invalidRequest = 400;

    /**
     * 用户没有权限
     * @var int
     */
    public static $unauthorized = 401;

    /**
     * 用户发出的请求针对的是不存在的记录
     * @var int
     */
    public static $notFound = 404;

    /**
     * 用户请求的格式不可得
     * @var int
     */
    public static $notAcceptable = 406;

    /**
     * 服务器发生错误
     * @var int
     */
    public static $internalServerError = 500;

}