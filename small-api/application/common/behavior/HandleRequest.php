<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\behavior;

use app\common\VCode;

/**
 * 处理请求数据
 * Class HandleRequest
 * @package app\common\behavior
 */
class HandleRequest
{

    public function run($params)
    {
        $request = request();
        $param = $request->param();
        if (isset($param['v_validate_class'])) {
            $className = $param['v_validate_class'];
            $class = '\\app\\common\\validate\\' . ucwords($className) . 'Validate';
            $validate = new $class;
            if (isset($param['v_validate_scene'])) {
                $validate->scene($param['v_validate_scene']);
            }
            $isCheck = $validate->check($param);
            if (!$isCheck) {
                $controller = $params[0];
                $data = [
                    'message' => $validate->getError(),
                    'name' => 'FIELD_VALIDATION_ERROR',
                    'code' => VCode::$notAcceptable,
                ];
                $controller->restful($data);
            }
        }
    }
}