<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\Controller;
use think\exception\HttpResponseException;
use think\facade\Response;

class VController extends Controller
{

    /**
     * 请求参数
     * @var array
     */
    protected $param;

    /**
     * 初始化
     */
    protected function initialize()
    {
        $this->param = $this->request->param();
    }

    /**
     * 返回 restful
     * @param $data
     * @param string $type
     * @param array $header
     */
    public function restful($data, $type = 'json', $header = [])
    {
        $response = Response::create($data, $type)->header($header);

        throw new HttpResponseException($response);
    }



}

