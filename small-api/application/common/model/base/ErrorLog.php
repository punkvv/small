<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\base;

use app\common\VModel;

class ErrorLog extends VModel
{
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
}