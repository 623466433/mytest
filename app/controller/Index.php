<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/5
 * Time: 16:03
 */

namespace app\controller;

use \core\Config;
class Index
{
    public function index(){
        echo Config::getIns()->get("err_info");
    }
}