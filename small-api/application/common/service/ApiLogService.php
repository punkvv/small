<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service;

use app\common\model\ApiLog;
use app\common\VService;

class ApiLogService extends VService
{
    public function getList($param)
    {
        $this->data = ApiLog::getList($param);

        return $this->result();
    }
}