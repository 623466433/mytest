<?php
namespace core;

class Config
{
    private static $config;
    private static $config_keys;
    private static $Ins;

    private function __construct(){
        $config_file = CONFIG_PATH . "/config.php";
        if(!file_exists($config_file)){
            throw new \Exception("{$config_file} is not exist!");
        }
        if(empty(static::$config)){
            static::$config = require_once $config_file;
            if(!is_array(static::$config)){
                throw new \Exception("this config.php is not return an array!");
            }
            static::$config_keys = array_keys(static::$config);
        }
    }

    public function get($key){
        if(!in_array($key,static::$config_keys)){
            throw new \Exception("unknow the index of {$key}");
        }
        return static::$config[$key];
    }

    public function set($key,$value){

    }

    static public function getIns(){
        if(empty(static::$Ins)){
            static::$Ins = new self();
        }
        return static::$Ins;
    }
}