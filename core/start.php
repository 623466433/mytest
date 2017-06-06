<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/5
 * Time: 10:37
 */
header("Content-type: text/html; charset=utf-8");
require __DIR__."/../vendor/autoload.php";
//实例化错误捕捉类
$whoops = new  \Whoops\Run;
$handler = new \Whoops\Handler\PrettyPageHandler;
$handler->setPageTitle("运行出现错误了");//设置报错页面的title
$whoops->pushHandler($handler);
if (\Whoops\Util\Misc::isAjaxRequest()) {//设置处理ajax报错的信息
    $whoops->pushHandler(new JsonResponseHandler);
}
$whoops->register();
$CONFIG = require __DIR__."/../config/config.php";
require __DIR__."/../config/routes.php";

