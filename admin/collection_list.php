<?php
include_once("../includes/init.php");
include_once("public/common.php");


$website = $db->select()->from("website")->all();

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
        <h1 class="page-title">节点管理</h1>
    </div>
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Index</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="btn-toolbar">
                <button class="btn btn-primary"><i class="icon-asterisk"></i> 已采集节点</button>
            </div>
            <div class="well">
                <table class="table">
                    <thead>
                    <tr>
                        <th>节点名称</th>
                        <th>节点文件</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($website as $item){?>
                        <tr>
                            <td><a href="book.php"><?php echo $item['name'];?></a></td>
                            <td><a href="book.php"><?php echo $item['code'].".php";?></a></td>
                            <td>
                                <button class="btn btn-primary" onclick="location='cli.php'"><i class="icon-hand-down"></i> 立刻采集</button>
                            </td>
                        </tr>
                    <?php }?>


                    </tbody>
                </table>
            </div>


            <?php include_once('public/footer.php');?>



