<?php
include_once("../includes/init.php");
include_once("public/common.php");

$id = $_GET['id']?? 0;
if ($id) {
    $book_data = $db->select()->from("book")->where("id={$id}")->find();
}

if ($_POST){
    $data = [
        'title'=>trim($_POST['title']),
        'author'=>trim($_POST['author']),
        'content'=>trim($_POST['content']),
        'cateid'=>trim($_POST['cateid']),
        'url'=>trim($_POST['url']),
        'register_time'=>time(),
        'id'=>trim($_POST['id'])
    ];

    //判断是否有文件上传
    if($uploads->isFile())
    {
        //判断文件是否上传成功
        if($uploads->upload())
        {
            if ($id){
                @is_file(ASSETS_PATH.$book_data['thumb']) && @unlink(ASSETS_PATH.$book_data['thumb']);
            }
            //获取上传的文件名
            $data['thumb'] = $uploads->savefile();
        }else{
            //显示错误信息
            show($uploads->getMessage());
            exit;
        }
    }

    if($data['id']){
        $index = $db->table('book')->update($data)->where("id={$data['id']}")->rows();
    }else{
        $index = $db->table('book')->insert($data)->run();
    }
    if ($index){
        show('操作成功','book_list.php');
    }else{
        show('操作失败');
    }
    exit;

}


$catelist = $db->select()->from("cate")->all();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include_once('public/meta.php');?>
      <link rel="stylesheet" href="<?php echo ASSETS_PATH?>/plugin/kindeditor/themes/default/default.css" />
      <script src="<?php echo ASSETS_PATH?>/plugin/kindeditor/kindeditor-min.js"></script>
      <script src="<?php echo ASSETS_PATH?>/plugin/kindeditor/lang/zh_CN.js"></script>
<!--      //使用kindeditor需要引入这段script-->
      <script>
          var editor;
          KindEditor.ready(function(K) {
              editor = K.create('textarea[name="content"]', {
                  allowFileManager : true
              });
          });
      </script>
  </head>

  <body> 

    <!-- 引入头部 -->
    <?php include_once('public/header.php');?>
    
    <?php include_once('public/menu.php');?>

    <div class="content">
        <div class="header">
            <h1 class="page-title">添加书籍</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">Index</li>
        </ul>

        <div class="container-fluid">

            <div class="row-fluid">
                    
                <div class="btn-toolbar">
                    <button class="btn btn-primary" onClick="location='book_list.php'"><i class="icon-list"></i> 返回书籍列表</button>
                  <div class="btn-group">
                  </div>
                </div>

                <div class="well">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="home">
                            <form method="post" enctype="multipart/form-data">
<!--                                隐藏域-->
                                <input type="hidden" value="<?php echo $book_data['id']??0;?>" name="id">
                                <label>书籍分类</label>
                                <select required name="cateid" class="input-xlarge">
                                    <option value="">请选择</option>
                                    <?php foreach($catelist as $item){?>
                                        <option
                                            <?php echo isset($book_data['cateid']) && $book_data['cateid']==$item['id'] ? "selected":"";?>
                                            value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
                                    <?php }?>
                                </select>
                                <label>书籍标题</label>
                                <input type="text" value="<?php echo $book_data['title']??'' ?>" class="input-xxlarge" name="title" required placeholder="请输入书籍标题" />

                                <label>书籍作者</label>
                                <input type="text" value="<?php echo $book_data['author']??'' ?>" class="input-xxlarge" name="author" required placeholder="请输入书籍作者" />

                                <label>爬取链接</label>
                                <input type="text" value="<?php echo $book_data['url']??'' ?>" class="input-xxlarge" name="url" required placeholder="请输入爬取链接" />

                                <label>书籍封面</label>
                                <input type="file" value="" class="input-xxlarge" name="thumb" />
                                <?php if(isset($book_data['thumb']) && !empty($book_data['thumb'])){?>
                                    <div class="book_thumb">
                                        <img class="img-responsive" src="<?php echo ASSETS_PATH.$book_data['thumb'];?>" />
                                    </div>
                                <?php }else{?>
                                    <div class="book_thumb">
                                        <img class="img-responsive" src="<?php echo ADMIN_PATH.'/images/cover.png';?>" />
                                    </div>
                                <?php }?>

                                <label>书籍内容</label>
                                <textarea value="Smith" rows="3" class="input-xxlarge" name="content">
                                    <?php echo $book_data['content']??'' ?>
                                </textarea>
                                <label></label>
                                <input class="btn btn-primary" type="submit" value="提交" />
                            </form>
                        </div>
                    </div>
                </div>

 <?php include_once('public/footer.php');?>



