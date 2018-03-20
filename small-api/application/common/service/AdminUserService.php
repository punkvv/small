<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\service;

use app\common\model\AdminUserRole;
use app\common\model\AdminUser;
use app\common\util\Encrypt;
use app\common\VService;

class AdminUserService extends VService
{

    public function getList($param)
    {
        $this->data = AdminUser::getList($param);

        return $this->result();
    }

    public function createData($param)
    {
        $data = AdminUser::create([
            'username' => $param['username'],
            'password' => Encrypt::generate($param['pass']),
            'avatar' => $param['avatar'],
            'real_name' => $param['real_name'],
            'phone' => $param['phone'],
            'email' => $param['email'],
        ]);
        $this->data = $data;

        return $this->result();
    }

    public function updateData($param)
    {
        $data = AdminUser::update([
            'id' => $param['id'],
            'username' => $param['username'],
            'avatar' => $param['avatar'],
            'real_name' => $param['real_name'],
            'phone' => $param['phone'],
            'email' => $param['email'],
        ]);
        $this->data = $data;

        return $this->result();
    }

    public function deleteData($id)
    {
        AdminUser::falseDelete($id);

        return $this->result();
    }

    public function getUserInfo($adminId)
    {
        $info = AdminUser::getInfoById($adminId);
        $router = [];
        if (1 != $adminId) {
            $menus = AdminUser::getMenuList($adminId);
            $router = [];
            foreach ($menus as $menu) {
                $router = array_merge($router, array_filter(explode(',',
                    $menu['name'] . ',' . $menu['parent_name'] . ',' . $menu['router'])));
            }
            $router = array_unique($router);
        }
        $this->data['user_info'] = $info;
        $this->data['router'] = implode(',', $router);

        return $this->result();
    }

    public function changeStatus($id, $type)
    {
        AdminUser::changeStatus($id, $type);

        return $this->result();
    }

    public function changePassword($param)
    {
        $data = AdminUser::update([
            'id' => $param['id'],
            'password' => Encrypt::generate($param['pass']),
        ]);
        $this->data = $data;

        return $this->result();
    }

    public function getRoleList($adminId)
    {
        $this->data = AdminUser::getRoleList($adminId);

        return $this->result();
    }

    public function createRole($param)
    {
        $adminId = $param['id'];
        $items = $param['items'];
        $list = [];
        foreach ($items as $item) {
            $list[] = [
                'role_id' => $item,
                'admin_id' => $adminId,
            ];
        }
        AdminUserRole::where('admin_id', $adminId)->delete();
        $adminRoleMenu = new AdminUserRole;
        $adminRoleMenu->saveAll($list);

        return $this->result();
    }

    public function updateUser($adminId, $param)
    {
        $data = AdminUser::update([
            'id' => $adminId,
            'username' => $param['username'],
            'avatar' => $param['avatar'],
            'real_name' => $param['real_name'],
            'phone' => $param['phone'],
            'email' => $param['email'],
        ]);
        $this->data = $data;

        return $this->result();
    }

    public function updatePassword($adminId, $param)
    {
        $data = AdminUser::update([
            'id' => $adminId,
            'password' => Encrypt::generate($param['pass']),
        ]);
        $this->data = $data;

        return $this->result();
    }
}