<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\base\facade;

use think\Facade;

/**
 * @see \app\common\model\base\ErrorLog
 * @mixin \app\common\model\base\ErrorLog
 */
class ErrorLog extends Facade
{
    protected static function getFacadeClass()
    {
        return '\app\common\model\base\ErrorLog';
    }
}