<?php

/*
 * Author: PunkVv <punkv@qq.com>
 */

namespace app\common\model;

use app\common\VModel;

class Menu extends VModel
{
    protected static function init()
    {
        // 删除后置操作
        self::afterDelete(function ($data) {
            // 把中间表数据清空
            RoleMenu::where('menu_id', $data->id)->delete();
            // 把子类清空
            Menu::where('parent_id', $data->id)->delete();
        });
    }

    public static function getList()
    {
        $items = static::field('id,name,menu_name,parent_id,router')
            ->order('id')->select();

        return $items;
    }
}