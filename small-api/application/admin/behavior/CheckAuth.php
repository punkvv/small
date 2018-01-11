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
    // 免权限检查 API
    private $whiteList = [
        'admin/login/login',
        'admin/login/logout',
    ];


    public function run($params)
    {
        $request = request();
        $rule = $request->routeInfo()['rule'];
        if (!in_array($rule, $this->whiteList)) {
            $controller = $params[0];
            // 检查 token
            $controller->checkToken();
            // TODO 检查 API 权限
            if (!$this->checkApi($rule)) {
                $data['message'] = '没有权限';
                $data['name'] = 'NO_AUTHORITY';
                $data['code'] = HttpCode::$unauthorized;
                $controller->restful($data);
            }
        }
    }

    private function checkApi($rule)
    {
        return true;
    }
}