<?php

return [
    // 默认使用微信小程序配置
    'default' => 'wechat',

    'gateways' => [
        // 微信
        'wechat' => [
            'driver' => 'WeChat',
            'appid'     => env('WX_MINI_APPID', ''),
            'secret'     => env('WX_MINI_SECRET', ''),
        ],

        'toutiao' => [
            'driver' => 'TouTiao',
            'appid'     => env('TT_MINI_APPID', ''),
            'secret'     => env('TT_MINI_SECRET', ''),
        ],

        'baidu' => [
            'driver' => 'BaiDu',
            'appid'     => env('BD_MINI_APPID', ''),
            'secret'     => env('BD_MINI_SECRET', ''),
        ]
    ]
];
