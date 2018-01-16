<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\permission;

use app\common\VModel;

class AdminUser extends VModel
{

    /**
     * @param $username
     * @return array|null|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getInfoByName($username)
    {
        $data = $this->field('id,username,password,status')
            ->where('username', $username)
            ->find();

        return $data;
    }

    /**
     * @param $userId
     * @return array|null|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getInfoById($userId)
    {
        $data = $this->field('id,username,avatar')->where('id', $userId)->find();

        return $data;
    }
}