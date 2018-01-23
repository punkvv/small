<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\facade;

use think\Facade;

/**
 * @see \app\common\model\ErrorLog
 * @mixin \app\common\model\ErrorLog
 */
class ErrorLog extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\common\model\ErrorLog';
    }
}