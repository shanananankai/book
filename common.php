<?php
include_once("includes/init.php");
$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : "";

if(!empty($keyword))
{
  $where = "title LIKE '%$keyword%'";
}else{
  $where = "";
}

//最新书籍
$new = $db->select()->from("book")->where("flag = 'new' AND $where")->limit(0,20)->all();

//网友推荐
$hot = $db->select()->from("book")->where("flag = 'hot' AND $where")->limit(0,20)->all();

//置顶
$top = $db->select()->from("book")->where("flag = 'top' AND $where")->limit(0,20)->all();


//查询所有的分类
$catelist = $db->select()->from("cate")->all();


?>