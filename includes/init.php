<?php

include_once("extends/function.php");
include_once("helpers.php");
date_default_timezone_set("Asia/Shanghai");

//E_ALL 显示所有错误  0 隐藏所有错误
error_reporting(E_ALL);
session_start();

$path = str_replace("\\","/",dirname(dirname(__FILE__)));
$home = "./assets/home";
$admin = "../assets/admin";
$uploads = "../assets/uploads";
$assets = "../assets";
$home_assets = "./assets";

//常量 APP_PATH 项目根目录
define("APP_PATH",$path);

//前台目录 HOME
define("HOME_PATH",$home);
define("ADMIN_PATH",$admin);
define("UPLOAD_PATH",$uploads);
define("ASSETS_PATH",$assets);
define("HOME_ASSETS",$home_assets);


//写一个自动加载的函数 PHP内置 自动触发 当发现 new 实例化类不存在的时候会自动调用
//function __autoload($classname)
//{
//  $classname = strtolower($classname);
//  include_once("extends/class.$classname.php");
//}

//php7抛弃了__autoload 换这种方式
function My_Autoload ($classname) {
    $classname = strtolower($classname);
    include_once("extends/class.$classname.php");
}
spl_autoload_register('My_Autoload');

$db = new DB("localhost","root","root","book");
//$fun= new FUN();
//$fun->p(1);


$Strings = new Strings();
$uploads = new Uploads();


$config_c = $db->select()->from("config")->all();
foreach ($config_c as $item){
    $config[$item['name']] = $item['content'];
}

?>