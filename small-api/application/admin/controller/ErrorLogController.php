<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\service\base\ErrorLogService;
use app\common\VController;

class ErrorLogController extends VController
{
    public function index()
    {
        $service = new ErrorLogService();
        $data = $service->getList($this->param);

        return $data;
    }

    public function dynamicCount()
    {
        $service = new ErrorLogService();
        $data = $service->getDynamicCount();

        return $data;
    }

    public function changeStatus()
    {
        $service = new ErrorLogService();
        $data = $service->changeStatus($this->param['id'], $this->param['type']);

        return $data;
    }

    public function changeStatusAll()
    {
        $service = new ErrorLogService();
        $data = $service->changeStatusAll();

        return $data;
    }

    public function deleteAll()
    {
        $service = new ErrorLogService();
        $data = $service->deleteAll();

        return $data;
    }

    public function save()
    {
        $service = new ErrorLogService();
        $data = $service->createData($this->param);

        return $data;
    }
}