<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\v1\controller;

use app\common\VCode;

class MissController
{
    public function index()
    {
        $data['message'] = 'Not Found';
        $data['name'] = 'HTTP_NOT_FOUND';
        $data['code'] = VCode::$notFound;

        return $data;
    }
}