<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\permission\facade;

use think\Facade;

/**
 * @see \app\common\model\permission\AdminUser
 * @mixin \app\common\model\permission\AdminUser
 */
class AdminUser extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\common\model\permission\AdminUser';
    }
}