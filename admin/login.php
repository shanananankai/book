<?php
include_once("../includes/init.php");

$adminid = isset($_SESSION['adminid']) ? trim($_SESSION['adminid']) : false;

if($adminid)
{
    //如果有adminid说明登录过
    checkLogin(true);
    exit;
}
if($_POST)
{

    if(strtolower($_SESSION['imgcode']) != strtolower($_POST['imgcode']))
    {
        show('验证码错误，请重新输入','login.php');
    }
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';

    $where = [
        "username"=>$username,
    ];


    $admin = $db->select()->from("admin")->where($where)->find();
    if(!$admin)
    {
        show("该用户不存在",'login.php');
    }else{
        //验证密码
        $salt = $admin['salt'];
        $password = $admin['password'];
        $repass = isset($_POST['password']) ? trim($_POST['password']) : "";
        if($password != md5($repass.$salt))
        {
            show('密码错误','login.php');
        }else{
            //登录后台

            //先将登录的用户存到session 前台的用户用cookie 后台用session
            $_SESSION['adminid'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];
            show('登录成功','index.php');
        }

    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("public/meta.php");?>
</head>

<body>

<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="index.php"><span class="second">Admin</span></a>
    </div>
</div>

<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">登录</p>
            <div class="block-body">
                <form method="post">
                    <label>用户名</label>
                    <input type="text" name="username" class="span12" placeholder="请输入用户名" required />
                    <label>密码</label>
                    <input type="password" name="password" class="span12" placeholder="请输入密码" required />
                    <label>验证码</label>
                    <input type="text" name="imgcode" class="span12" placeholder="请输入验证码" required />
                    <div>
                        <img src='./public/imgcode.php' onclick="this.src='./public/imgcode.php?random='+Math.random()" />
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">登录</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include_once('public/footer.php');?>



