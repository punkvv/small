<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\behavior;

use app\common\HttpCode;
use app\common\VSession;

/**
 * 权限检查
 * Class CheckAuth
 * @package app\admin\behavior
 */
class CheckAuth
{
    public function run($params)
    {
        $request = request();
        $param = $request->param();
        if (!isset($param['v_check']) || $param['v_check']) {
            $rule = $request->routeInfo()['rule'];
            $methods = $request->method();
            $controller = $params[0];
            // 检查 token
            $controller->checkToken();
            // TODO 检查 API 权限
            if (!$this->checkApi($rule, $methods)) {
                $data['message'] = '没有权限';
                $data['name'] = 'NO_AUTHORITY';
                $data['code'] = HttpCode::$unauthorized;
                $controller->restful($data);
            }
        }
    }

    private function checkApi($rule, $methods)
    {
        return true;
    }
}