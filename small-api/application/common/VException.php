<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use app\common\model\base\facade\ErrorLog;
use Exception;
use think\exception\Handle;
use think\facade\Config;
use think\facade\Request;
use think\Response;

class VException extends Handle
{
    public function render(Exception $e)
    {
        $debug = Config::get('app_debug');
        if ($debug) {
            return parent::render($e);
        } else {
            // 记录异常日志到数据库
            ErrorLog::addData(Request::domain().Request::url(),
                sprintf("%s:%d %s (%d) [%s]\n", $e->getFile(), $e->getLine(),
                    $e->getMessage(), $e->getCode(), get_class($e)));
            // 返回异常
            $data['code'] = HttpCode::$internalServerError;
            $data['name'] = 'INTERNAL_SERVER_ERROR';
            $data['message'] = '服务器异常';
            $response = Response::create($data, 'json')->header([]);

            return $response;
        }
    }
}