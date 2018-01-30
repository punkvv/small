<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\service\UploadService;
use app\common\VController;

class UploadController extends VController
{
    public function image()
    {
        $service = new UploadService();
        $data = $service->imageLocal();

        return $data;
    }
}