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
     * 新建或修改数据成功
     * @var int
     */
    public static $created = 201;

    /**
     * 请求已经进入后台排队
     * @var int
     */
    public static $accepted = 202;

    /**
     * 删除数据成功
     * @var int
     */
    public static $noContent = 204;

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
     * 用户得到授权（与401错误相对），但是访问是被禁止的
     * @var int
     */
    public static $forbidden = 403;

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
     * 用户请求的资源被永久删除
     * @var int
     */
    public static $gone = 410;

    /**
     * 当创建一个对象时，发生一个验证错误
     * @var int
     */
    public static $unprocesableEntity = 422;

    /**
     * 服务器发生错误
     * @var int
     */
    public static $internalServerError = 500;

}