<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/5
 * Time: 10:44
 * 数据库连接配置
 */
return [
    // 必须配置项
    'database_type' => 'mysql',
    'database_name' => 'cajs',
    'server' => '127.0.1.1',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',

    // 可选参数
    'port' => 3306,

    // 可选，定义表的前缀
    'prefix' => '',

    // 连接参数扩展, 更多参考 http://www.php.net/manual/en/pdo.setattribute.php
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];