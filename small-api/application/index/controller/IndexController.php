<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\index\controller;

use app\common\HttpCode;

class IndexController
{
    public function miss()
    {
        $data['message'] = 'Not Found';
        $data['name'] = 'HTTP_NOT_FOUND';
        $data['code'] = HttpCode::$notFound;

        return $data;
    }
}