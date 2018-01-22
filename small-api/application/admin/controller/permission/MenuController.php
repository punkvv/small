<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller\permission;

use app\common\service\permission\MenuService;
use app\common\VController;

class MenuController extends VController
{
    public function index()
    {
        $service = new MenuService();
        $data = $service->getList();

        return $data;
    }

    public function create()
    {
        $service = new MenuService();
        $data = $service->createData($this->param);

        return $data;
    }

    public function countFiled()
    {
        $service = new MenuService();
        $data = $service->countFiled($this->param['filed'], $this->param['value']);

        return $data;
    }
}