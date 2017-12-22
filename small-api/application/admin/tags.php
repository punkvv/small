<?php

/**
 * Author: PunkVv <punkv@qq.com>
 */

// 应用行为扩展定义文件
return [
    // 操作开始执行
    'action_begin' => [
        'app\\admin\\behavior\\CheckAuth', // 权限检查
    ],
];
