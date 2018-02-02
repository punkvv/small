<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\v1\controller;

use app\common\HttpCode;

class MissController
{
    public function index()
    {
        $data['message'] = 'Not Found';
        $data['name'] = 'HTTP_NOT_FOUND';
        $data['code'] = HttpCode::$notFound;

        return $data;
    }
}