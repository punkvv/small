<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service;

use app\common\HttpCode;
use app\common\token\Token;
use app\common\VService;

class AdminUserService extends VService
{

    public function getUserInfo($token)
    {
        $user = Token::get($token);
        if (empty($user)) {
            // token 无效或者过期
            $this->code = HttpCode::$tokenFail;
            $this->name = HttpCode::$TOKEN_FAIL;
            $this->message = 'token 无效或者过期';
        }
        dump($user);
    }
}