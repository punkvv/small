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
        $data = $service->getList($this->param);

        return $data;
    }
}