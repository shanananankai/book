<?php
include_once("../includes/init.php");
include_once("public/common.php");

$id = $_GET['id']?? 0;
if ($id){
    if ($db->table('cate')->delete($id)->rows()){
        echo '<script>history.go(-1);</script>';
    }
}

//当前页码数
$page = $_GET['page']?? 1;

//总条数
$count = $db->select("COUNT(id) AS c")->from("cate")->find();

//每页显示多少条
$limit = 4;

//中间的页码数
$size = 6;

//调用分页函数，生成分页字符串
$pageStr = page($page,$count['c'],$limit,$size, 'yellow');

//偏移量
$start = ($page-1)*$limit;

//查询数据
$cate_list = $db->select()->from("cate")->limit($start,$limit)->all();



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
            <h1 class="page-title">分类列表</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">Index</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="btn-toolbar">
                    <button class="btn btn-primary" onClick="location='cate.php'"><i class="icon-plus"></i> 添加分类</button>
                </div>
                <div class="well">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><input type="checkbox" name="delete" id="delete" /></th>
                            <th>分类ID</th>
                            <th>分类名称</th>
                            <th style="width: 26px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cate_list as $item){?>
                                <tr>
                                    <td><input type="checkbox" class="items" name="bookid[]" value="<?php echo $item['id'];?>" /></td>
                                    <td><?php echo $item['id'];?></td>
                                    <td><?php echo $item['name'];?></td>
                                    <td>
                                        <a href="cate.php?id=<?php echo $item['id'];?>"><i class="icon-pencil"></i></a>
                                        <a href="cate_list.php?id=<?php echo $item['id'];?>"><i class="icon-remove"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>

            <div class="pull-left">
                <?php echo $pageStr?>
            </div>



<?php include_once('public/footer.php');?>



