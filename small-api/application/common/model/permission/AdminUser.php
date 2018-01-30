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

    public function getList($param)
    {
        $query = $this->field('id,username,avatar,status,real_name,phone,email')
            ->where('is_del', 1)
            ->where('id', '<>', 1)
            ->order('id', 'desc');
        if (!empty($param['name'])) {
            $query->whereLike('username|real_name|phone', "%{$param['name']}%");
        }
        if (!empty($param['status'])) {
            $query->where('status', $param['status']);
        }
        $data = $this->queryPaginate($query, $param);

        return $data;
    }
}