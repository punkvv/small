<?php

/**
 * Author: PunkVv <punkv@qq.com>
 */

// 应用行为扩展定义文件
return [
    // 操作开始执行
//    'action_begin' => [
//        'app\\common\\behavior\\HandleRequest', // 处理请求数据
//    ],
    // 响应发送
    'response_send' => [
        'app\\common\\behavior\\HandleResponse', // 处理响应数据
    ],
];
