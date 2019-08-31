<?php

$book_data = $db->select()->from("book")->where("id={$_POST['manhua_id']}")->find();
//解开unicode编码
$url = urldecode($book_data['url']);

$collect = $_POST['collect'];
if (!$collect){
    jump('我问你,你想看多少集?','cli.php');
}

$collect_arr = explode(',',$collect);
$count_collect = count($collect_arr);


foreach ($collect_arr as $collect){

    $file_path = './collection/'.$book_data['title']."/{$collect}话";
    if(!is_dir($file_path))
    {
        mkdir($file_path,0744,true);
    }

    preg_match("/(\d+)话/imsU", $url,$res);

//拿到最新一话的地址
    $url2 = str_replace($res[1],$collect,$url);
    preg_match("/(.*).jpg-mht.low.webp/imsU", $url2,$u);

//获取修改好第n集的前半段url
    $start_url = substr($u[1],0, strrpos($u[1], '/'));

//剪出后半段url;
    $end_url = substr($url2,strlen($start_url),-1).'p';

    preg_match("/(\d+).jpg-mht.low.webp/imsU", $url2,$result);


    $sum = 40;
    if ($book_data['id'] == 33){
//    斗罗大陆第一季比较多页
        $sum = 70;
    }
    for ($x=1; $x<=$sum; $x++) {
//    循环修改后半段的url地址
        $last_url = str_replace($result[1],$x,$end_url);

        //拼合最后的url
        $c_curl = $start_url.$last_url;
        $curl = curl_init($c_curl);
        curl_setopt($curl, CURLOPT_HEADER, 0); // 设置是否显示header信息 0是不显示，1是显示 默认为0
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //返回数据，而不是直接输出
        //curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_jar); //发送cookie文件
        $content = curl_exec($curl); //发送HTTP请求

        $imageList = file_put_contents("{$file_path}/{$x}.webp",$content);

    }

    $chapterList = [
        'register_time'=>time(),
        'title'=> $book_data['title']."{$collect}话",
        'content'=>'./img_load.php?book_id='.$book_data['id'].'&collect='."{$collect}话",
        'bookid'=>$book_data['id']
    ];

    $db->table('chapter')->insert($chapterList)->rows();
}



jump("该漫画新增了第{$count_collect}话","book_list.php");


?>