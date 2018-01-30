<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\system\facade;

use think\Facade;

/**
 * @see \app\common\model\system\AdminUser
 * @mixin \app\common\model\system\AdminUser
 */
class AdminUser extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\common\model\system\AdminUser';
    }
}