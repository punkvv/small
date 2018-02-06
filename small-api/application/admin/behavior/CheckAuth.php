<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\behavior;

use app\common\VCode;
use app\common\model\ApiLog;
use think\facade\Config;

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
                $data = [
                    'message' => '没有权限',
                    'name' => 'NO_AUTHORITY',
                    'code' => VCode::$unauthorized,
                ];
                $controller->restful($data);
            } elseif ((!isset($param['v_log']) || $param['v_log']) && !Config::get('app_debug')) {
                // 记录 API 日志
                ApiLog::addData($controller->adminId(), $rule, $param['v_name'], $param, $methods);
            }
        }
    }

    private function checkApi($rule, $methods)
    {
        return true;
    }
}