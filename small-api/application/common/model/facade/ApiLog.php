<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\facade;

use think\Facade;

/**
 * @see \app\common\model\ApiLog
 * @mixin \app\common\model\ApiLog
 */
class ApiLog extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\common\model\ApiLog';
    }
}