<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\service\ApiLogService;
use app\common\VController;

class ApiLogController extends VController
{
    public function index()
    {
        $service = new ApiLogService();
        $data = $service->getList($this->param);

        return $data;
    }
}