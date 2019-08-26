<?php
include_once("../includes/init.php");
include_once("public/common.php");

$id = $_GET['id']?? 0;
if ($id){
    $data = $db->select()->from("admin")->where("id={$id}")->find();

}

if ($_POST){

    $salt = get_rand_str(12);
    $pwd = trim($_POST['password']) ?: "";

    $data['id'] = trim($_POST['id']) ?: 0;
    $data['username'] = trim($_POST['username']) ?: "";
    $data['email'] = trim($_POST['email']) ?: "";
    $data['password'] = md5($pwd.$salt);
    $data['register_time'] = time();
    $data['salt'] = $salt;

    if($data['id']){
        $index = $db->table('admin')->update($data)->where("id={$data['id']}")->rows();
    }else{
        $index = $db->table('admin')->insert($data)->run();
    }
    if (!$index){
        jump('操作失败', 'admin.php');
    }
    jump('操作成功', 'admin_list.php');
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once('public/meta.php');?>
  </head>

  <body> 

    <!-- 引入头部 -->
    <?php include_once('public/header.php');?>
    
    <?php include_once('public/menu.php');?>

    <div class="content">
        <div class="header">
            <h1 class="page-title">发布文章</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">Index</li>
        </ul>

        <div class="container-fluid">

            <div class="row-fluid">
                    
                <div class="btn-toolbar">
                    <button class="btn btn-primary" onClick="location='admin_list.php'"><i class="icon-list"></i> 返回管理员列表</button>
                  <div class="btn-group">
                  </div>
                </div>

                <div class="well">
                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane active in" id="home">
                        <form method="post" id="form_admin">
                            <input type="hidden" name="id" value="<?php echo $data['id']??"";?>"/>

                            <label>用户名</label>
                            <input type="text" name="username" required value="<?php echo $data['username']??"";?>" class="input-xxlarge" placeholder="请输入用户名" />
                            <label>邮箱</label>
                            <input type="text" name="email" required value="<?php echo $data['email']??"";?>" class="input-xxlarge" placeholder="请输入邮箱" />
                            <label>密码</label>
                            <input type="password" name="password" required class="input-xxlarge" placeholder="请输入密码" />
                            <label>确认密码</label>
                            <input type="password" name="password2" required class="input-xxlarge" placeholder="请再次输入密码" />

                            <label></label>
                            <input class="btn btn-primary" type="submit" value="提交" />
                        </form>
                      </div>
                  </div>
                </div>

                <script>
                    $("#form_admin").submit( function () {
                        var pwd1 = $("input[name='password']").val();
                        var pwd2 = $("input[name='password2']").val();

                        if (pwd1 !== pwd2){
                            alert('两次密码不相同');
                            return false;
                        }
                    } );
                </script>

<?php include_once('public/footer.php');?>


