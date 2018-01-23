<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\permission\facade;

use think\Facade;

/**
 * @see \app\common\model\permission\AdminRole
 * @mixin \app\common\model\permission\AdminRole
 */
class AdminRole extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\common\model\permission\AdminRole';
    }
}