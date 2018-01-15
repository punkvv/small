<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common;

use think\Model;

class VModel extends Model
{

    /**
     * 绑定参数
     * @var array
     */
    protected static $bind = [];

    /**
     * 条件
     * @var array
     */
    protected static $where = [];


}