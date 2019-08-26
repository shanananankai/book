<?php
include_once("includes/init.php");
include_once("common.php");

$chapterid = isset($_GET['chapterid']) ? $_GET['chapterid'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : "pages";
//if(!$chapterid)
//{
//    show("无章节数据");
//    exit;
//}

$bookinfo = $db->select()->from("chapter")->where("id = $chapterid")->find();
$book_id = $bookinfo['bookid'];
$book = $db->select()->from("book")->where("id = $book_id")->find();
//小说
if ($book['cateid']==1){
    $url = './admin/'.$bookinfo['content'];
    $content = is_file($url) ? file_get_contents($url) : "";

    if(empty($content))
    {
        show("该章节无内容","booklist.php");
        exit;
    }
    $json = json_decode($content,true);
    $title = $json['title'];

}
//漫画
if ($book['cateid']==2){
//    $colle  =
    $colle  = substr($bookinfo['content'],strpos($bookinfo['content'],'collect=')+8);
    $url = './admin/collection/'.$book['title'].'/'.$colle.'/';
    $sum = 40;
    if ($book_id == 33){
//    斗罗大陆第一季比较多页
        $sum = 70;
    }
    $title = $book['title'];
}



//上一篇 和 下一篇
$prev = $db->select("id")->from('chapter')->where("id < $chapterid ")->orderby("id","desc")->find();

$next = $db->select("id")->from('chapter')->where("id > $chapterid ")->orderby("id","asc")->find();



?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once('meta.php');?>
</head>
<body>
<div id="nav-over"></div>
<div id="warmp" class="warmp">
	<?php include_once('header.php');?>
	
	<div class="dh">
    <a href="index.php">首页</a> > 
    <span style="color:#999999;">
        <strong><?php echo $title;?></strong></span>
    <?php if($action == "pages"){?>
      <a style="float:right;" href="bookinfo.php?chapterid=<?php echo $chapterid;?>&action=down">下拉阅读</a>
    <?php }else{?>
      <a style="float:right;" href="bookinfo.php?chapterid=<?php echo $chapterid;?>&action=pages">分页阅读</a>
    <?php }?>
  </div>
	<article class="article">
		<h1 class="hd"><?php echo $title;?></h1>
		<div class="article-con">
            <?php if($book['cateid']==1){ ?>
                <?php echo $json['content'];?>
            <?php } ?>
            <?php if($book['cateid']==2){ ?>
                <?php for ($x=1; $x<=$sum; $x++) {?>
                    <img class="lazy" src="<?php echo $url.$x?>.webp" style="width: 80%;margin: 30px 10% 0 10%;">
                <?php }?>
            <?php } ?>
		</div>
	</article>
	<div class="pagelist">
    <?php if($prev){?>
      <li><a href="bookinfo.php?chapterid=<?php echo $prev['id'];?>">上一页</a></li>
    <?php }else{?>
      <li><a href="javascript:void(0)">无上一页</a></li>
    <?php }?>
    <?php if($next){?>
      <li><a href="bookinfo.php?chapterid=<?php echo $next['id'];?>">下一页</a></li>
    <?php }else{?>
      <li><a href="javascript:void(0)">无下一页</a></li>
    <?php }?>
  </div>

  <?php include_once("footer.php");?>
</div>

<?php include_once("menu.php");?>

</body>
</html>
<script src="./assets/home/js/index.js"></script>
