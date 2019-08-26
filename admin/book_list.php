<?php
include_once("../includes/init.php");
include_once("public/common.php");

$id = $_GET['id']?? 0;
$delete = $_GET['delete']?? 0;

if ($_POST){
    $bookid = implode(",",$_POST['bookid']);
    $bookdelete = $db->select("thumb")->from("book")->where("id IN($bookid)")->all();
    $rows = $db->table('book')->delete("where","id IN($bookid)")->rows();
    if ($rows){
        if($bookdelete)
        {
            foreach($bookdelete as $item)
            {
                @is_file(ASSETS_PATH.$item['thumb']) && @unlink(ASSETS_PATH.$item['thumb']);
            }
        }
    }
}
//当前页码数
$page = $_GET['page']?? 1;
//总条数
$count = $db->select("COUNT(id) AS c")->from("book")->find();
//每页显示多少条
$limit = 3;
//中间的页码数
$size = 3;
//调用分页函数，生成分页字符串
$pageStr = page($page,$count['c'],$limit,$size, 'yellow');
//偏移量
$start = ($page-1)*$limit;
//查询数据
$book_list = $db->select("book.*,cate.name")->from("book", "book")->join("cate","book.cateid = cate.id")->limit($start,$limit)->all();

if ($id){
    if ($delete){
        $db->table('book')->delete($id)->rows();
        echo '<script>history.go(-1);</script>';
    }
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
        <h1 class="page-title">书籍列表</h1>
    </div>
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Index</li>
    </ul>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="btn-toolbar">
                <button class="btn btn-primary" onClick="location='book.php'"><i class="icon-plus"></i> 添加书籍</button>
            </div>
            <div class="well">
                <table class="table">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="delete" id="delete" /></th>
                        <th>ID</th>
                        <th>书籍标题</th>
                        <th>作者</th>
                        <th>所属分类</th>
                        <th>封面</th>
                        <th>更新时间</th>
                        <th style="width: 26px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <form method="post">

                    <?php if (isset($book_list['code']) && $book_list['code']==0 ){?>
                        <tr>
                            <td colspan="20">暂无数据</td>
                        </tr>
                    <?php }else{?>
                        <?php foreach($book_list as $item){?>
                            <tr>
                                <td><input type="checkbox" class="items" name="bookid[]" value="<?php echo $item['id'];?>" /></td>
                                <td><?php echo $item['id'];?></td>
                                <td><a href="book_desc_list.php?book_id=<?php echo $item['id'];?>" style="color: blue;"><?php echo $item['title'];?></a></td>
                                <td><?php echo $item['author'];?></td>
                                <td><?php echo $item['name'];?></td>
                                <td>
                                    <div class="book_thumb" style="width: 40px;" >
                                        <img class="img-responsive" src="<?php echo $item['thumb']? ASSETS_PATH.$item['thumb'] : ADMIN_PATH.'/images/cover.png';?>" />
                                    </div>
                                </td>
                                <td><?php echo date("Y-m-d H:i:s",$item['register_time']);?></td>
                                <td>
                                    <a href="book.php?id=<?php echo $item['id'];?>"><i class="icon-pencil"></i></a>
                                    <a href="book_list.php?id=<?php echo $item['id']."&delete=1";;?>"><i class="icon-remove"></i></a>
                                </td>
                            </tr>
                        <?php }?>
                    <?php }?>
                        <tr>
                            <td colspan="20" style="text-align:left;">
                                <button type="submit">批量删除</button>
                            </td>
                        </tr>
                    </form>
                    </tbody>
                </table>
            </div>




            <div class="pull-left">
                <?php echo $pageStr;?>
            </div>

            <script>
                function del(bookid)
                {
                    $("#bookid").val(bookid);
                }
            </script>
            <?php include_once('public/footer.php');?>



