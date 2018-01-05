<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service;

use app\common\model\AdminUser;
use app\common\util\Encrypt;
use app\common\validate\AdminUserValidate;
use app\common\VService;

class AdminUserService extends VService
{

    /**
     * 用户登录
     * @param array $param
     * @return array
     */
    public function login(array $param)
    {
        $validate = new AdminUserValidate();
        if ($this->validate($param, $validate, 'login')) {
            $username = $param['username'];
            $password = $param['password'];
            $info = AdminUser::getInfoByName($username);
            $this->status = 0;
            if (!$info) {
                $this->message = '用户不存在';
            } elseif ($info->status !== 1) {
                $this->message = '用户已被禁用';
            } elseif (!Encrypt::validate($password, $info->password)) {
                $this->message = '密码不正确';
            } else {
                $this->status = 1;
            }
        }

        return $this->result();
    }
}