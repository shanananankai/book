<?php
/**
 * [jump 跳转函数]
 * @param  [string] $msg [提示的信息]
 * @param  string $url [跳转地址]
 * @return [type]      [description]
 */
function jump($msg,$url=''){
	if($url!=''){
		echo '<script>alert("'.$msg.'");location.href="'.$url.'";</script>';
	}else{
		echo '<script>alert("'.$msg.'");history.go(-1);</script>';
	}
	exit;
}

/*打印数组*/
function p($star){
	echo '<pre style="background: rgba(255,204,204,.5);color: #FF6633;">';
	print_r($star);
	echo '</pre>';
	exit;
}

/*上传文件*/
function uploadfile($path,$n,$type){
	// 创建文件夹
	if(!file_exists($path)){
		mkdir($path,0777,true);
	}
	// 上传文件
	if( !empty($_FILES) && $_FILES[$n]['error']==0  ){
		// 做类型的限制（图片、压缩包）
		// 提取文件的后缀名  
		// 
		$name = $_FILES[$n]['name']; // 文件名称（对文件重新命名）作业：名字+后缀名

		// 判断是否是中文名称（正则）
		// if( preg_match('/^[\u4e00-\u9fa5]+$/', $name) ){		// true false		（php的中文正则不能这样写）
		// 正确写法
		if( preg_match('/([\x{4e00}-\x{9fa5}]+)/u', $name) ){		// true false
			jump('不能上传中文文件');
		}

		// 获取文件后缀名
		$ext = pathinfo($name,PATHINFO_EXTENSION);

		// 判断文件类型
		if( $type==1 && !in_array($ext,array('jpg','jpeg','png','gif')) ){
			// 类型不对提示
			jump("图片格式不对！");
		}
		if( $type==2 && !in_array($ext,array('mp4','avi','swf')) ){
			// 类型不对提示
			jump("视频格式不对！");
		}

		// 判断文件大小
		
		
		$fname = date('YmdHis').'00'.mt_rand(1000,9999).'.'.$ext;
		move_uploaded_file($_FILES[$n]['tmp_name'], $path.'/'.$fname);	// 函数（14）  转移

		return str_replace('../', '', $path.'/'.$fname);
	}
}


/**
 * 获得用户的真实IP地址
 *
 * @access  public
 * @return  string
 */
function real_ip()
{
    static $realip = NULL;

    if ($realip !== NULL)
    {
        return $realip;
    }

    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ($arr AS $ip)
            {
                $ip = trim($ip);

                if ($ip != 'unknown')
                {
                    $realip = $ip;

                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;
}

/*
* 中文字符截取
* @param      string        $string       被处理的字符串
* @param      int           $start        开始截取的位置
* @param      int           $length       截取的字符长度
* @param      string        $dot          缩略符号
* @param      string        $charset      字符编码
* @return       string      $new          成功截取后的字符串
*/
function cutstr($string, $start, $length, $dot = '',$charset = "utf-8") {
	//判断当前的环境中是否开启了mb_substr这个函数
	if(function_exists("mb_substr")){
		
		if(mb_strlen($string,$charset)>$length){
			//如果开启了就可以直接使用这个
			return mb_substr($string,$start,$length,$charset).$dot;
		}
		return mb_substr($string,$start,$length,$charset);
	}
	//否则就是下面没开启
	$new = '';
	//判断是否是gbk，是gbk就转码成utf-8
	if($charset==='gbk'){
		$string = iconv("gbk","utf-8",$string);
	}
	//下面这个只能使用在utf-8的编码格式中
	$str = preg_split('//u',trim($string));
	for($i = $start,$len = 1;$i<count($str)-1 && $len<=$length;$i++,$len++){
		$new .= $str[$i+1];
	}
	//如果是gbk，就需要在返回结果之前，把之前的转换编码恢复一下
	if($charset==='gbk'){
		$new = iconv("utf-8","gbk",$new);
	}
	return count($str)-2<$length?$new:$new.$dot;
}

/**
 * @/获取随机字符串
 * @param int $length
 * @return bool|string
 */
function get_rand_str($length = 4)
{
    $chars = '1234567890ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnobqrstuvwxyz';
    $str = str_shuffle($chars); //随机打乱一个字符串
    $str = substr($str,0,$length);
    $str = strtolower($str);
    return $str;
}



//得到当前网址
function get_url(){
    $str = $_SERVER['PHP_SELF'].'?';
    if($_GET){
        foreach ($_GET as $k=>$v){  //$_GET['page']
            if($k!='page'){
                $str .= $k.'='.$v.'&';
            }
        }
    }
    return $str;
}



//分页函数
/**
 *@pargam $current	当前页
 *@pargam $count	记录总数
 *@pargam $limit	每页显示多少条
 *@pargam $size		中间显示多少条
 *@pargam $class	样式
 */
function page($current,$count,$limit,$size,$class='sabrosus'){
    $str='';
    if($count>$limit){
        $pages = ceil($count/$limit);//算出总页数
        $url = get_url();//获取当前页面的URL地址（包含参数）

        $str.='<div class="'.$class.'">';
        //开始
        if($current==1){
            $str.='<span class="disabled">首&nbsp;&nbsp;页</span>';
            $str.='<span class="disabled">  &lt;上一页 </span>';
        }else{
            $str.='<a href="'.$url.'page=1">首&nbsp;&nbsp;页 </a>';
            $str.='<a href="'.$url.'page='.($current-1).'">  &lt;上一页 </a>';
        }
        //中间
        //判断得出star与end

        if($current<=floor($size/2)){ //情况1
            $star=1;
            $end=$pages >$size ? $size : $pages; //看看他两谁小，取谁的
        }else if($current>=$pages - floor($size/2)){ // 情况2

            $star=$pages-$size+1<=0?1:$pages-$size+1; //避免出现负数

            $end=$pages;
        }else{ //情况3

            $d=floor($size/2);
            $star=$current-$d;
            $end=$current+$d;
        }

        for($i=$star;$i<=$end;$i++){
            if($i==$current){
                $str.='<span class="current">'.$i.'</span>';
            }else{
                $str.='<a href="'.$url.'page='.$i.'">'.$i.'</a>';
            }
        }
        //最后
        if($pages==$current){
            $str .='<span class="disabled">  下一页&gt; </span>';
            $str.='<span class="disabled">尾&nbsp;&nbsp;页  </span>';
        }else{
            $str.='<a href="'.$url.'page='.($current+1).'">下一页&gt; </a>';
            $str.='<a href="'.$url.'page='.$pages.'">尾&nbsp;&nbsp;页 </a>';
        }
        $str.='</div>';
    }

    return $str;
}





//获取文件数
function ShuLiang($url)//造一个方法，给一个参数
{
    $sl=0;//造一个变量，让他默认值为0;
    $arr = glob($url);//把该路径下所有的文件存到一个数组里面;
    foreach ($arr as $v)//循环便利一下，吧数组$arr赋给$v;
    {
        if(is_file($v))//先用个if判断一下这个文件夹下的文件是不是文件，有可能是文件夹;
        {
            $sl++;//如果是文件，数量加一;
        }

    }
    return $sl;//当这个方法走完后，返回一个值$sl,这个值就是该路径下所有的文件数量;
}


