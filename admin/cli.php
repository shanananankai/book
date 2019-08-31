<?php
include_once("../includes/init.php");
include_once("public/common.php");

$website = $db->select()->from("website")->all();
$cate1 = $db->select()->from("book")->where('cateid=1')->all();
$cate2 = $db->select()->from("book")->where('cateid=2')->all();

if($_POST){
    if (empty($_POST['manhua_id']) && empty($_POST['book_id'])){
        jump('请选中要爬取的书籍或漫画');
    }
    include_once("{$_POST['code']}.php");

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once('public/meta.php');?>

    <link rel="stylesheet" href="<?php echo ADMIN_PATH;?>/stylesheets/flat_ui_tag.css">

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
                    <button class="btn btn-primary" onClick="location='collection_list.php'"><i class="icon-list"></i> 返回节点管理</button>
                  <div class="btn-group">
                  </div>
                </div>

                <div class="well">
                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane active in" id="home">

                        <form method="post">
                            <label>采集节点</label>
                            <?php foreach ($website as $item){?>
                                <label class="radio inline" id="change" style="margin-left:2px;">
                                    <input type="radio" name="code" value="<?php echo $item['code']?>">
                                    <?php echo $item['name']?>
                                </label>
                            <?php }?>


                            <div id="site1" style="display: none">
                                <label style="margin-top: 15px"></label>
                                <label>书籍名称</label>
                                <select name="book_id" class="input-xlarge" >
                                    <option value="">请选择书籍名称</option>
                                    <?php foreach($cate1 as $item){?>
                                        <option value="<?php echo $item['id'];?>"><?php echo $item['title'];?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div id="site2" style="display: none">
                                <label style="margin-top: 15px"></label>
                                <label>漫画名称</label>
                                <select name="manhua_id" class="input-xlarge" >
                                    <option value="">请选择漫画名称</option>
                                    <?php foreach($cate2 as $item){?>
                                        <option value="<?php echo $item['id'];?>"><?php echo $item['title'];?></option>
                                    <?php }?>
                                </select>

                                <label>集数</label>
                                <div class="form-item">
                                    <div class="box">
                                        <div class="tagsinput-primary form-group">
                                            <input name="collect" id="tagsinputval" class="tagsinput" data-role="tagsinput" placeholder="输入后回车" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <label style="margin-top: 15px;"></label>
                            <input class="btn btn-primary" type="submit" id="skk" value="提交" />
                        </form>
                      </div>
                  </div>
                </div>

                <script>
                    $('input[type=radio][name=code]').change(function() {
                        if (this.value == 'site1'){
                            $("#site1").show();
                            $("#site2").hide();
                        }
                        if (this.value == 'site2'){
                            $("#site2").show();
                            $("#site1").hide();
                        }
                    });
                </script>

<script src="<?php echo ADMIN_PATH;?>/js/flat_ui_tag.js"></script>

<?php include_once('public/footer.php');?>



