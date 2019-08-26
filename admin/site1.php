<?php

    $book_data = $db->select()->from("book")->where("id={$_POST['book_id']}")->find();

    $str = file_get_contents($book_data['url']);

    $listReg = "/<title>(.*)<\/title>/imsU";
    preg_match($listReg,$str,$res);

    if ($res[1] == '访问异常'){
        jump('被禁掉啦~! 换个wifi继续爬吧','cli.php');
        exit;
    }


    //    echo $str;  ////调试
//    file_put_contents("collection/文章列表.html",$str,FILE_APPEND);

//    FILE_APPEND追加写入不填则默认覆盖
//    file_put_contents("collection/文章列表.html",$str);

//    测试本地文件,匹配好了再用网站的url
//    $str = file_get_contents("collection/文章列表.html");
//    echo $str;


//    i   在和模式进行匹配时不区分大小写
//    m   将字符串视为多行
//    s   模式中的圆点元字符 “ . “将匹配所有的字符，包括换行符
//    U   取消贪婪匹配
//    \s  匹配一个空白字符；等价于[\f\n\r\t\v]
//    (.*) 将匹配的结果以新的数组下标返回到数组里

    //preg_match()匹配拿一个大的数据  匹配ul标签里的所有内容,其余都不需要
    $listReg = "/<ul class=\"chapter-list clearfix\">\s*<li.*>(.*)<\/li>\s*<\/ul>/imsU";
    preg_match($listReg,$str,$res);

    $lilist = $res[1];

    //preg_match_all()匹配拿所有的数据
    $liReg = "/<a.*href=\"(.*)\".*>(.*)<\/a>/imsU";
    preg_match_all($liReg,$lilist,$result);
    $urllist = $result[1];
    $titlelist = $result[2];
    //拿齐标题和地址


    $time = date("md");
    $path = APP_PATH."/assets/site1/".$book_data['title'].'_'.$time;
    $url_path = "../assets/site1/".$book_data['title'].'_'.$time;

    if(!is_dir($path)){
        mkdir($path,0744,true);
    }

    //循环获取所有地址下的文章
    foreach($urllist as $key=>$item)
    {
        //$item则是所有链接地址
        $str = file_get_contents($item);
//        $str = file_get_contents('collection/文章页.html');
        $contentReg = "/<div\s*class=\"content\"\s*.*>(.*)<\/div>/imsU";
        preg_match($contentReg, $str,$text);
        $content = strip_tags($text[1]);
        $title = $titlelist[$key];

        $arr = array("title" => $title, "content" => $content);
        $json = json_encode($arr);

        //保存文件
        $filename = $title.".json";
        $length = @file_put_contents($path."/".$filename,$json);
        if($length > 0){
            $chapterList[] = array(
                "register_time"=>time(),
                "title"=>$title,
                "content"=>"$url_path/{$filename}",
                "bookid"=> $book_data['id']
            );
        }

    }

    if(is_array($chapterList) && count($chapterList) > 0)
    {
        $affectRow = $db->table('chapter')->insert($chapterList)->rows();
        show("该书籍新增了{$affectRow}章内容","book_list.php");
    }else{
        exit;
        show("当前采集节点无数据","cli.php");
    }

exit;





?>