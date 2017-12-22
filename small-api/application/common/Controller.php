<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\Controller as ThinkController;
use think\Request;

class Controller extends ThinkController
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var 请求参数
     */
    protected $param;

    /**
     * 初始化
     */
    protected function initialize()
    {
        $this->request = request();
        $this->param = $this->request->param();
    }
}

