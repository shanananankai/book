<?php

//跳转提醒

function show($msg="",$url="")
{
  @header("Content-Type:text/html;charset=utf-8");
  if(empty($url))
  {
    echo "<script>alert('$msg');history.go(-1);</script>";
  }else{
    echo "<script>alert('$msg');location.href='$url';</script>";
  }
    exit;
}

//验证管理员是否登录
//location 默认不跳转
function checkLogin($location = false,$url='')
{
  global $db;  //获取全局变量
  $adminid = isset($_SESSION['adminid']) ? $_SESSION['adminid'] : 0;
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';


  //两个只要有其中一个不存在
  if(!$adminid || empty($username))
  {
    session_unset();
    show('登录有误，请重新登录','login.php');
  }else{
    //两个都存在
    $where = [
      "id"=>$adminid,
      "username"=>$username
    ];

    $admin = $db->select()->from("admin")->where($where)->find();

    if(!$admin)
    {
      session_unset();
      show('登录有误,请重新登录','login.php');
    }

    if($location)
    {
      //location 等于true 说明要跳转
      if($url)
      {
        //给了地址就跳转指定地址
        header("Location:$url");
        exit;
      }else{
        //没有地址就跳转到默认首页
        header("Location:index.php");
        exit;
      }

    }
  }
}

?>