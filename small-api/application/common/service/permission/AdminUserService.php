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
        if (1 !== $adminId) {
            $menus = AdminMenu::getListByAdminId($adminId);
            $router = [];
            foreach ($menus as $menu) {
                $router = array_merge($router, array_filter(explode(',', $menu['name'].','.$menu['router'])));
            }
            $router = array_unique($router);
        }
        $this->data['user_info'] = $info;
        $this->data['router'] = $router;

        return $this->result();
    }
}