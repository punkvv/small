<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\Controller as ThinkController;
use think\Request;

class Controller extends ThinkController
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * 请求参数
     * @var array
     */
    protected $param;

    /**
     * token
     * @var string
     */
    protected static $token;

    /**
     * 初始化
     */
    protected function initialize()
    {
        $this->request = request();
        $this->param = $this->request->param();
        static::setToken();
    }

    private static function setToken()
    {
        $header = request()->header();
        static::$token = empty($header['x-token']) ? '' : $header['x-token'];
    }

    public static function getToken()
    {
        if (!isset(static::$token)) {
            static::setToken();
        }

        return static::$token;
    }
}

