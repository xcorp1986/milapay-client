<?php

$config = [
    'apiurl'    => 'https://www.yoursite.com/addons/pay/api/create',
    'secretkey' => 'your secretkey'
];

// 错误显示级别
error_reporting(E_ALL);
// 设置时区
ini_set('date.timezone', 'Asia/Shanghai');
// 强制服务器编码
header("Content-Type: text/html; charset=utf-8");
// 设置mbstring字符编码
mb_internal_encoding("UTF-8");

