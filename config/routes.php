<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/5
 * Time: 16:15
 * 路由配置文件
 */
//var_dump($_SERVER);
use NoahBuscher\Macaw\Macaw;

Macaw::get('fuck/:id', function($id) {
    echo $id;
});

Macaw::get('/', "app\controller\Index@index");
Macaw::error(function() {
    global $CONFIG;
    header("content");
    echo $CONFIG['err_info'];
});

Macaw::dispatch();