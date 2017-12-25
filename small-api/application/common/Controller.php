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
    }


    public static function getToken()
    {
        if (!static::$token) {
            $header = request()->header();
            static::$token = $header['x-token'];
        }

        return static::$token;
    }
}

