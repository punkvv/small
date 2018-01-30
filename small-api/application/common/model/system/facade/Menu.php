<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model\system\facade;

use think\Facade;

/**
 * @see \app\common\model\system\Menu
 * @mixin \app\common\model\system\Menu
 */
class Menu extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\common\model\system\Menu';
    }
}