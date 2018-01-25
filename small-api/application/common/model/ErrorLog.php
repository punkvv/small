<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model;

use app\common\VModel;

class ErrorLog extends VModel
{
    public function getList($param)
    {
        $query = $this->field('id,create_time,router,message,type,status')
            ->where('is_del', 1);
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
        $query->order('id', 'desc');

        return $this->queryPaginate($query, $param);
    }

    public function addData(string $router, string $message, int $type = 1)
    {
        $data = $this->create([
            'create_time' => time(),
            'router' => $router,
            'message' => $message,
            'type' => $type,
        ]);

        return $data;
    }

    public function getDataById($id)
    {
        $data = $this->field('id,create_time,router,message,type,status')->where('id', $id)->find();

        return $data;
    }
}