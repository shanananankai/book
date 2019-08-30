<?php
include_once("includes/init.php");
include_once("common.php");

 $chapterid = isset($_GET['chapterid']) ? $_GET['chapterid'] : 0;

if(!$chapterid)
{
    show("无章节数据");
    exit;
}

$bookinfo = $db->select()->from("chapter")->where("id = $chapterid")->find();
$book_id = $bookinfo['bookid'];
$book = $db->select()->from("book")->where("id = $book_id")->find();

//分页
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$action = isset($_GET['action']) ? $_GET['action'] : "";
$limit = 1;

$low_id = $db->select('id')->from("chapter")->where(['bookid'=>$book_id])->orderby('id','asc')->find();

//进来的id减去最开始的id
$start = ($chapterid-$low_id['id'])+$page-2;


//小说
if ($book['cateid']==1){
    //上拉加载
    if($action == "page"  && $page!=1)
    {
        $chapter_all = $db->select()->from("chapter")->where(['bookid'=>$book_id])->limit($start,$limit)->all();
//        p($chapter_all);
//        $chapter_all = $db->select()->from("chapter")->where(['bookid'=>$book_id])->limit($start,$limit)->all();

        $count = $db->select("COUNT(id) AS c")->from("chapter")->where("bookid = $book_id")->find();
        foreach ($chapter_all as $k => $v){
            $url = './admin/'.$v['content'];
            $content = is_file($url) ? file_get_contents($url) : "";

            $json = json_decode($content,true);
            $chapter_all[$k]['content'] = $json['content'];
        }

        $result = array("chapter_list"=>$chapter_all,"count"=>$count);

        echo json_encode($result);
        exit;
    }

//    下拉刷新
    if($action == "reset")
    {
        //直接查询书籍

        $chapter_all = $db->select()->from("chapter")->where(['id'=>$chapterid,'bookid'=>$book_id])->all();
        foreach ($chapter_all as $k => $v){
            $url = './admin/'.$v['content'];
            $content = is_file($url) ? file_get_contents($url) : "";

            $json = json_decode($content,true);
            $chapter_all[$k]['content'] = $json['content'];
        }

        echo json_encode($chapter_all);
        exit;
    }

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
//$prev = $db->select("id")->from('chapter')->where("id < $chapterid ")->orderby("id","desc")->find();
//
//$next = $db->select("id")->from('chapter')->where("id > $chapterid ")->orderby("id","asc")->find();



?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once('meta.php');?>
    <link rel="stylesheet" href="./assets/plugin/mescroll/mescroll.min.css" />
    <script src="./assets/plugin/mescroll/mescroll.min.js"></script>

    <!-- 模板引擎插件 -->
    <script src="./assets/plugin/templatejs/template.js"></script>
    <style>
        .mescroll{
            position: fixed;
            top: 144px;
            bottom: 50px;
            height: auto; /*如设置bottom:50px,则需height:auto才能生效*/
        }
    </style>
</head>
<body>
<div id="nav-over"></div>
<div id="warmp" class="warmp">
	<?php include_once('header.php');?>
	
	<div class="dh">
        <a href="index.php">首页</a> >
        <span style="color:#999999;">
            <strong>
                <?php if ($book['cateid']==2){ ?>
                    <?php echo $title;?>
                <?php }?>
            </strong></span>
    </div>

	<article class="article">
		<div class="article-con">

            <?php if($book['cateid']==1){ ?>
<!--                --><?php //echo $json['content'];?>
                <div id="mescroll" class="mescroll list-index">
                    <div id="articlelist" class=articlelist>
                    </div>
                </div>
            <?php } ?>


            <?php if($book['cateid']==2){ ?>
                <?php for ($x=1; $x<=$sum; $x++) {?>
                    <img class="lazy" src="<?php echo $url.$x?>.webp" style="width: 80%;margin: 30px 10% 0 10%;">
                <?php }?>
            <?php } ?>

		</div>
	</article>
<!--	<div class="pagelist">-->
<!--        --><?php //if($prev){?>
<!--          <li><a href="bookinfo.php?chapterid=--><?php //echo $prev['id'];?><!--">上一页</a></li>-->
<!--        --><?php //}else{?>
<!--          <li><a href="javascript:void(0)">无上一页</a></li>-->
<!--        --><?php //}?>
<!--        --><?php //if($next){?>
<!--          <li><a href="bookinfo.php?chapterid=--><?php //echo $next['id'];?><!--">下一页</a></li>-->
<!--        --><?php //}else{?>
<!--          <li><a href="javascript:void(0)">无下一页</a></li>-->
<!--        --><?php //}?>
<!--    </div>-->

<!--  --><?php //include_once("footer.php");?>
</div>

<?php include_once("menu.php");?>

</body>
</html>
<script src="./assets/home/js/index.js"></script>

<script id="tpl" type="text/html">
    <%for(var i = 0; i < list.length; i++) {%>
        <div style="width: 80%;margin-left: 20px;">
            <h1 class="hd" style="height: 50px;margin: 20px auto; line-height:50px;text-align:center;background: black;color: #fff"><%:=list[i].title%></h1>
            <%:=list[i].content%>
        </div>
    <%}%>
</script>
<script>
    var mescroll = new MeScroll("mescroll",{
        //设置下拉刷新回调
        down:{
            callback: downCallback,
        },

        //设置上拉加载
        up:{
            callback: upCallback,
            page: {
                num: 0, //当前页 默认0,回调之前会加1; 即callback(page)会从1开始
                size: 1, //每页数据条数,默认10
            },
        }
    });

    //下拉刷新的回调函数 (数据清空)
    function downCallback()
    {
        $.ajax({
            url: 'bookinfo.php?action=reset&chapterid=<?php echo $chapterid;?>&page=1&cateid=1',
            dataType:"json",
            success: function(data) {
                var tpl = document.getElementById('tpl').innerHTML;
                var str = template(tpl, {list: data});
                $("#articlelist").html("");
                $("#articlelist").html(str);
                mescroll.resetUpScroll();
                mescroll.endSuccess(); //无参. 注意结束下拉刷新是无参的
            },
            error: function(data) {
                //联网失败的回调,隐藏下拉刷新的状态
                mescroll.endErr();
            }
        });
    }

    //上拉加载 (增加数据)
    function upCallback(page)
    {
        var pageNum = page.num; // 页码, 默认从1开始 如何修改从0开始 ?

        $.ajax({
            url: `bookinfo.php?action=page&chapterid=<?php echo $chapterid+1;?>&page=${pageNum}&cateid=1`,
            dataType:"json",
            success: function(data) {
                var curPageData = data.chapter_list; // 接口返回的当前页数据列表
                var totalSize = data.count.c; // 接口返回的总数据量

                var tpl = document.getElementById('tpl').innerHTML;
                var str = template(tpl, {list: curPageData});
                $("#articlelist").append(str);
                // mescroll.endSuccess(); //无参. 注意结束下拉刷新是无参的

                //方法二(推荐): 后台接口有返回列表的总数据量 totalSize
                //必传参数(当前页的数据个数, 总数据量)
                mescroll.endBySize(curPageData.length, totalSize);
            },
            error: function(e) {
                //联网失败的回调,隐藏下拉刷新和上拉加载的状态
                mescroll.endErr();
            }
        });
    }

</script>