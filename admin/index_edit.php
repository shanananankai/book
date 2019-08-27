<?php
include_once("../includes/init.php");
include_once("public/common.php");

if ($_POST){
    $datas = $_POST;
    foreach ($config_c as $item){
        $config[$item['name']] = $item['content'];
    }
    $data = [];
    $sum = 0;
    foreach ($datas as $k => $v){
        $data[$sum]['name'] = $k;
        $data[$sum]['content'] = $v;
        $sum++;
    }
    //判断是否有文件上传
    if($uploads->isFile())
    {
        //判断文件是否上传成功
        if($uploads->upload())
        {
            if ($config['logo']){
                @is_file(ASSETS_PATH.$config['logo']) && @unlink(ASSETS_PATH.$config['logo']);
            }
            $data[$sum]['name'] = 'logo';
            $data[$sum]['content'] = $uploads->savefile();
        }else{
            //显示错误信息
            show($uploads->getMessage());
            exit;
        }
    }

    $index = $db->table('config')->insert($data)->rows();

    if (!$index){
        jump('操作失败', 'index.php');
    }
    jump('操作成功', 'index.php');
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
            <h1 class="page-title">后台首页</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">Index</li>
        </ul>

        <div class="container-fluid">

            <div class="row-fluid">
                    
                <div class="btn-toolbar">
                    <button class="btn btn-primary" onClick="location='index.php'"><i class="icon-list"></i> 返回首页</button>
                  <div class="btn-group">
                  </div>
                </div>

                <div class="well">
                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane active in" id="home">
                         <form method="post" enctype="multipart/form-data">
                            <label>版权</label>
                            <input type="text" name="company" required value="<?php echo $config['company']??"";?>" class="input-xxlarge" placeholder="请输入版权" />
                            <label>地址</label>
                            <input type="text" name="address" required value="<?php echo $config['address']??"";?>" class="input-xxlarge" placeholder="请输入地址" />
                            <label>邮箱</label>
                            <input type="text" name="email" required value="<?php echo $config['email']??"";?>" class="input-xxlarge" placeholder="请输入邮箱" />
                            <label>手机</label>
                            <input type="text" name="phone" required value="<?php echo $config['phone']??"";?>" class="input-xxlarge" placeholder="请输入手机" />

                            <label>seo关键字</label>
                            <input type="text" name="keywords" required value="<?php echo $config['keywords']??"";?>" class="input-xxlarge" placeholder="请输入seo关键字" />

                            <label>网站描述</label>
                            <input type="text" name="description" required value="<?php echo $config['description']??"";?>" class="input-xxlarge" placeholder="请输入网站描述" />

                            <label>logo</label>
                            <input type="file" class="input-xxlarge" name="logo" />
                             <img class="img-responsive" src="<?php echo isset($config['logo']) && !empty($config['logo']) ? ASSETS_PATH.$config['logo'] : '' ;?>" />

                            <label>网站标题</label>
                            <input type="text" name="title" required value="<?php echo $config['title']??"";?>" class="input-xxlarge" placeholder="请输入网站标题" />

                            <label>网站作者</label>
                            <input type="text" name="author" required value="<?php echo $config['author']??"";?>" class="input-xxlarge" placeholder="请输入网站作者" />

                            <label></label>
                            <input class="btn btn-primary" type="submit" value="提交" />
                        </form>
                      </div>
                  </div>
                </div>


<?php include_once('public/footer.php');?>


