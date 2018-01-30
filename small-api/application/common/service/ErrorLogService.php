<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service;

use app\common\HttpCode;
use app\common\model\facade\ErrorLog;
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
        $this->data['count'] = ErrorLog::where('is_del', 1)->where('status', 2)->count();

        return $this->result();
    }

    public function createData($param)
    {
        $this->data = ErrorLog::addData($param['router'], $param['message'], 2);

        return $this->result();
    }

    public function changeStatus($id, $type)
    {
        ErrorLog::changeStatus($id, $type);

        return $this->result();
    }

    public function changeStatusAll()
    {
        $this->data['count'] = ErrorLog::where('is_del', 1)
            ->where('status', 0)
            ->setField('status', 1);

        return $this->result();
    }

    public function deleteAll()
    {
        $this->data['count'] = ErrorLog::where('is_del', 1)
            ->setField('is_del', 0);

        return $this->result();
    }
}