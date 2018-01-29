<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model;

use app\common\VModel;

class ApiLog extends VModel
{
    public function addData($adminId, $router, $routerName, $params)
    {
        unset($params['v_log']);
        unset($params['v_name']);
        unset($params['v_check']);
        $data = $this->create([
            'create_time' => time(),
            'router' => $router,
            'admin_id' => $adminId,
            'router_name' => $routerName,
            'params' => json_encode($params),
        ]);

        return $data;
    }
}