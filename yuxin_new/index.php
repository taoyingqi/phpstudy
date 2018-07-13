<?php
/**
 * Created by PhpStorm.
 * User: 卢军
 * Date: 2018/4/13
 * Time: 16:56
 */


// [ 应用入口文件 ]
session_start();
// 定义应用目录
define('APP_PATH', __DIR__ . '/app/');

// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';