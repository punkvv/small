<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\behavior;

use app\common\VSession;

/**
 * 处理请求数据
 * Class HandleRequest
 * @package app\common\behavior
 */
class HandleRequest
{
    /**
     * 设置 Token
     * @param $params
     */
    public function run($params)
    {
        $result = request();
        $header = $result->header();
        $token = empty($header['v-token']) ? '' : $header['v-token'];
        VSession::setToken($token);
    }
}