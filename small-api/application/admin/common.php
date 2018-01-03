<?php

/**
 * Author: PunkVv <punkv@qq.com>
 */

// 应用公共文件

function get_admin_id()
{
    return get_admin()['id'];
}

function get_admin()
{
    $data = \think\facade\Cache::get('admin'.\app\common\VController::getToken());

    return $data;
}
