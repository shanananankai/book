<?php
include_once("../includes/init.php");
include_once("public/common.php");

$act = isset($_GET['act']) ? trim($_GET['act']) : '';

if($act == "logout")
{
    session_unset();
    show("退出成功","login.php");
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once("public/meta.php");?>
  </head>

  <body>
    
    <!-- 引入头部 -->
    <?php include_once('public/header.php');?>
    
    <?php include_once('public/menu.php');?>

    <div class="content">
        <div class="header">
            <h1 class="page-title">后台首页</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">Index</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                <?php foreach ($config as $k => $v){?>
                    <div><?php echo $k.' : '.$v?></div>
                <?php }?>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <footer>
                    <hr>
                    <p>&copy; 2018  &nbsp;<a href="https://shankai.top" target="_blank">shankai.top</a></p>
                </footer>
            </div>
        </div>
    </div>
  </body>
</html>
<script src="<?php echo ADMIN_PATH;?>/lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
    });
</script>


