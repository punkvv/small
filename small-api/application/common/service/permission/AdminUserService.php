<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service\permission;

use app\common\model\permission\facade\AdminMenu;
use app\common\model\permission\facade\AdminUser;
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