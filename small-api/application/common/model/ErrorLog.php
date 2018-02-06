<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model;

use app\common\VModel;

class ErrorLog extends VModel
{
    public static function getList($param)
    {
        $query = static::field('id,create_time,router,message,type,status')
            ->where('is_del', 1)
            ->order('id', 'desc');
        if (!empty($param['type'])) {
            $query->where('type', $param['type']);
        }
        if (!empty($param['status'])) {
            $query->where('status', $param['status']);
        }
        if (!empty($param['create_time']) && count($param['create_time']) == 2) {
            $query->whereBetween('create_time',
                [strtotime($param['create_time'][0]), strtotime($param['create_time'][1])]);
        }

        return static::queryPaginate($query, $param);
    }

    public static function addData(string $router, string $message, int $type = 1)
    {
        $data = static::create([
            'create_time' => time(),
            'router' => $router,
            'message' => $message,
            'type' => $type,
        ]);

        return $data;
    }

    public static function getDataById($id)
    {
        $data = static::field('id,create_time,router,message,type,status')->where('id', $id)->find();

        return $data;
    }
}