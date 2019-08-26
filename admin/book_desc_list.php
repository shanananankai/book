<?php
include_once("../includes/init.php");
include_once("public/common.php");

$id = $_GET['id']?? 0;
$book_id = $_GET['book_id']?? 0;
$delete = $_GET['delete']?? 0;
$edit = $_GET['edit']?? 0;

if (!$book_id){
    jump('传参谢谢','book_list.php');
}

if ($id){
    if ($delete){
        if ($db->table('chapter')->update(['is_delete'=>1])->where(['id'=>$id])->rows()){
            echo '<script>history.go(-1);</script>';
        }
    }
//    if ($edit){
//        if ($db->table('chapter')->update(['is_delete'=>0])->where(['id'=>$id])->rows()){
//            echo '<script>history.go(-1);</script>';
//        }
//    }
}

//当前页码数
$page = $_GET['page']?? 1;

//已总条数
$count = $db->select("COUNT(id) AS c")->from("chapter")->where(['is_delete'=>0,'bookid'=>$book_id])->find();

//每页显示多少条
$limit = 5;

//中间的页码数
$size = 6;

//调用分页函数，生成分页字符串
$pageStr = page($page,$count['c'],$limit,$size,'yellow');

//偏移量
$start = ($page-1)*$limit;

//查询数据

$chapter_data = $db
    ->select("chapter.*,book.title as book_title")
    ->from("chapter", "chapter")
    ->join("book","chapter.bookid = book.id")
    ->where(['bookid'=>$book_id,'is_delete'=>0])->limit($start,$limit)->all();



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
        <h1 class="page-title">文章列表</h1>
    </div>
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Index</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="btn-toolbar">
                <button class="btn btn-primary" onclick="location='book_list.php'"><i class="icon-signin"></i>  <?php echo $chapter_data[0]['book_title']??"去采集文章";?></button>
            </div>
            <div class="well">
                <table class="table">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="delete" id="delete" /></th>
                        <th>文章标题</th>
                        <th>书籍名称</th>
                        <th>发布时间</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($chapter_data['code']) && $chapter_data['code']==0 ){?>
                        <tr>
                            <td colspan="20">暂无数据</td>
                        </tr>
                    <?php }else{?>
                        <?php foreach($chapter_data as $item){?>
                            <tr>
                                <a href=""></a>
                                <td><input type="checkbox" class="items" name="bookid[]" value="<?php echo $item['id']??"";?>" /></td>
                                <td><a href="<?php echo $item['content']??"";?>"><?php echo $item['title']??"";?></a></td>
                                <td><?php echo $item['book_title']??"";?></td>
                                <td><?php echo date("Y-m-d H:i:s",$item['register_time']??"");?></td>
                                <td>
                                    <a style="color: blue" href="book_desc_list.php?id=<?php echo $item['id']."&book_id={$book_id}&edit=1";?>"><i class="icon-pencil"></i></a>
                                    <a style="color: blue" href="book_desc_list.php?id=<?php echo $item['id']."&book_id={$book_id}&delete=1";?>"><i class="icon-remove"></i></a>
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



