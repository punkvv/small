<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\permission;

use app\common\VModel;

class AdminUser extends VModel
{

    public function getInfoByName($username)
    {
        $data = $this->field('id,username,password,status')
            ->where('username', $username)
            ->find();

        return $data;
    }

    public function getInfoById($userId)
    {
        $data = $this->field('id,username,avatar')->where('id', $userId)->find();

        return $data;
    }
}