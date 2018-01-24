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
        $where = '';
        $bind = [];
        if (!empty($param['type'])) {
            $where .= ' AND type=:type';
            $bind['type'] = $param['type'];
        }
        if (!empty($param['status'])) {
            $where .= ' AND status=:status';
            $bind['status'] = $param['status'];
        }
        if (!empty($param['create_time']) && count($param['create_time']) == 2) {
            $where .= ' AND create_time BETWEEN :begin AND :end';
            $bind['begin'] = strtotime($param['create_time'][0]);
            $bind['end'] = strtotime($param['create_time'][1]);
        }

        $page = $this->getPage($param);
        $select = 'SELECT id,create_time,router,message,type,status';
        $from = 'FROM t_error_log WHERE is_del=1'.$where.' ORDER BY id DESC';
        $data = $this->nativePaginate($select, $from, $page, $bind);

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