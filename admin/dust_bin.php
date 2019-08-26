<?php
include_once("../includes/init.php");
include_once("public/common.php");

$id = $_GET['id']?? 0;
$reset = $_GET['reset']?? 0;
$unset = $_GET['unset']?? 0;

if ($id){
    if ($reset){
        if ($db->table('admin')->update(['is_delete'=>0])->where(['id'=>$id])->rows()){
            echo '<script>history.go(-1);</script>';
        }
    }
    if ($unset){
        if ($db->table('admin')->delete($id)->rows()){
            echo '<script>history.go(-1);</script>';
        }
    }
}

//当前页码数
$page = $_GET['page']?? 1;

//已删除总条数
$count = $db->select("COUNT(id) AS c")->from("admin")->where(['is_delete'=>1])->find();

//每页显示多少条
$limit = 5;

//中间的页码数
$size = 6;

//调用分页函数，生成分页字符串
$pageStr = page($page,$count['c'],$limit,$size,'yellow');

//偏移量
$start = ($page-1)*$limit;

//查询数据
$dust_data = $db->select()->from("admin")->where(['is_delete'=>1])->limit($start,$limit)->all();



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
        <h1 class="page-title">已删除的管理员</h1>
    </div>
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Index</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="btn-toolbar">
                <button class="btn btn-primary" "><i class="icon-plus"></i> 已删除</button>
            </div>
            <div class="well">
                <table class="table">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="delete" id="delete" /></th>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>注册时间</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($dust_data['code']) && $dust_data['code']==0 ){?>
                        <tr>
                            <td colspan="20">暂无数据</td>
                        </tr>
                    <?php }else{?>
                        <?php foreach($dust_data as $item){?>
                            <tr>
                                <td><input type="checkbox" class="items" name="bookid[]" value="<?php echo $item['id'];?>" /></td>
                                <td><?php echo $item['id'];?></td>
                                <td><?php echo $item['username'];?></td>
                                <td><?php echo $item['email'];?></td>
                                <td><?php echo date("Y-m-d H:i:s",$item['register_time']);?></td>
                                <td>
                                    <a style="color: blue" href="dust_bin.php?id=<?php echo $item['id']."&reset=1";?>">恢复</a>
                                    <a style="color: blue" href="dust_bin.php?id=<?php echo $item['id']."&unset=1";?>">彻底删除</a>
                                </td>
                            </tr>
                        <?php }?>
                    <?php }?>

                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                <?php echo $pageStr?>
            </div>


            <?php include_once('public/footer.php');?>



