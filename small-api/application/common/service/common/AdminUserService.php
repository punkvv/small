<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service\common;

use app\common\model\common\AdminMenu;
use app\common\model\common\AdminUser;
use app\common\VService;

class AdminUserService extends VService
{

    public function getUserInfo($adminId)
    {
        $info = AdminUser::getInfoById($adminId);
        $router = [];
        if (1 == $adminId) {
            // 超级管理员
            // $menus = AdminMenu::getAll();
        } else {
            $menus = AdminMenu::getListByAdminId($adminId);
            $router = [];
        }

        $this->data['user_info'] = $info;
        $this->data['router'] = $router;

        return $this->result();
    }
}