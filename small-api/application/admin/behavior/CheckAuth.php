<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\admin\behavior;

use app\common\HttpCode;
use app\common\Token;

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
            $token = Token::getToken();
            $controller = $params[0];
            if (!$token) {
                // 检查 token
                $data['code'] = HttpCode::$unauthorized;
                $data['name'] = 'TOKEN_FAIL';
                $data['message'] = 'token 无效或者过期';
                $controller->restful($data);
            } else {
                // TODO 检查 API 权限
                if (!$this->check($rule)) {
                    $data['message'] = '没有权限';
                    $data['name'] = 'NO_AUTHORITY';
                    $data['code'] = HttpCode::$unauthorized;
                    $controller->restful($data);
                }
            }
        }
    }

    private function check($rule)
    {
        return true;
    }
}