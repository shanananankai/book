<?php
include_once("includes/init.php");
include_once("common.php");

$cateid = isset($_GET['cateid']) ? $_GET['cateid'] : 0;


$booklist =$db->select()->from("book")->where("cateid = $cateid")->all();


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
            bottom: 0;
            height: auto; /*如设置bottom:50px,则需height:auto才能生效*/
        }
    </style>
</head>

<body>
<div id="warmp" class="warmp">
    <?php include_once('header.php');?>

    <div class="dh"><a href="index.php">首页</a> > 数据列表：</div>
    <div id="mescroll" class="mescroll list-index">
        <ul id="articlelist" class=articlelist>
            <li>
                <?php foreach ($booklist as $item){?>
                    <a href="chapterlist.php?bookid=<?php echo $item['id']?>">
                        <?php echo $item['title']?>
                    </a>
                <?php }?>

            </li>

        </ul>
    </div>
</div>

<?php include_once("menu.php");?>

</body>
</html>
<script src="<?php echo HOME_PATH;?>/js/index.js"></script>
