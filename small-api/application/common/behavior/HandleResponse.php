<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\behavior;

use think\Response;

/**
 * 处理响应数据
 * Class HandleResponse
 * @package app\common\behavior
 */
class HandleResponse
{
    /**
     * @param $response Response
     */
    public function run($response)
    {
        $data = $response->getData();
        if (isset($data['code'])) {
            $code = $data['code'];
            unset($data['code']);
            $response->data($data);
            $response->code($code);
        }
    }
}