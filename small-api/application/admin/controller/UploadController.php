<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\controller;

use app\common\VController;

class UploadController extends VController
{
    public function image()
    {
        $request = request();
        $file = $request->file('file');
        dump($file);
        die;
    }
}