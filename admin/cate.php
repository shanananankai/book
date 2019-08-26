<?php
include_once("../includes/init.php");
include_once("public/common.php");

$id = $_GET['id']?? 0;
if ($id){
    $data = $db->select()->from("cate")->where("id={$id}")->find();
}


if ($_POST){

    $data['id'] = trim($_POST['id']) ?: 0;
    $data['name'] = trim($_POST['name']) ?: "";


    if($data['id']){
        $index = $db->table('cate')->update($data)->where("id={$data['id']}")->rows();
    }else{
        $index = $db->table('cate')->insert($data)->run();
    }
    if (!$index){
        jump('操作失败', 'cate.php');
    }
    jump('操作成功', 'cate_list.php');


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
            <h1 class="page-title">添加分类</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">Index</li>
        </ul>

        <div class="container-fluid">

            <div class="row-fluid">
                    
                <div class="btn-toolbar">
                    <button class="btn btn-primary" onClick="location='cate_list.php'"><i class="icon-list"></i> 返回分类列表</button>
                  <div class="btn-group">
                  </div>
                </div>

                <div class="well">
                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane active in" id="home">
                        <form method="post">
<!--                            隐藏域-->
                            <input type="hidden" name="id" value="<?php echo $data['id']??"";?>"/>
                            <label>分类名称</label>
                            <input type="text" name="name" required value="<?php echo $data['name']??"";?>" class="input-xxlarge" placeholder="请输入分类名称" />
                            <label></label>
                            <input class="btn btn-primary" type="submit" id="skk" value="提交" />
                        </form>
                      </div>
                  </div>
                </div>

 <?php include_once('public/footer.php');?>



