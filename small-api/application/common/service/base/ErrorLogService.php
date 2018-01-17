<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service\base;

use app\common\model\base\facade\ErrorLog;
use app\common\VService;

class ErrorLogService extends VService
{
    public function getList($param)
    {
        $this->data = ErrorLog::getList($param);

        return $this->result();
    }

    public function getDynamicCount()
    {
        $this->data = ErrorLog::where('is_del', 1)->count();

        return $this->result();
    }

    public function createData($param)
    {
        $this->data = ErrorLog::addData($param['router'], $param['message'], 2);

        return $this->result();
    }
}