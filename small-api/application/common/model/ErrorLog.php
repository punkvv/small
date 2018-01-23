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
        $gen = $this->genPage($param);
        $select = 'SELECT id,create_time,router,message,type,status';
        $from = 'FROM t_error_log WHERE is_del=1 ORDER BY id DESC';
        $data = $this->nativePaginate($select, $from, $gen);

        return $data;
    }

    public function addData(string $router, string $message, int $type = 1)
    {
        $data = [
            'create_time' => time(),
            'router' => $router,
            'message' => $message,
            'type' => $type,
        ];
        $this->save($data);
        $data['id'] = $this->getLastInsID();

        return $data;
    }

    public function getDataById($id)
    {
        $data = $this->field('id,create_time,router,message,type,status')->where('id', $id)->find();

        return $data;
    }
}