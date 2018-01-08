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
    public static $ok = 200;

    /**
     * 请求有误
     * @var int
     */
    public static $invalidRequest = 400;

    /**
     * token 过期或无效
     * @var int
     */
    public static $tokenFail = 401;
    public static $TOKEN_FAIL = 'TOKEN_FAIL';

    /**
     * 字段验证失败
     * @var string
     */
    public static $FIELD_TYPE_MISMATCH = 'FIELD_TYPE_MISMATCH';

    /**
     * 用户或者密码错误
     * @var string
     */
    public static $USER_AUTH_FAIL = 'USER_AUTH_FAIL';
}