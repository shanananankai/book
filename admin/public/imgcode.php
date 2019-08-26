<?php

//设置绝对路径,避免报错
$path = str_replace("\\","/",dirname(dirname(dirname(__FILE__))));

// 1,先创建一张指定宽度和高度的一张验证码图片 imagecreatetruecolor()
// 2，给验证码图片添加背景颜色 和文字颜色 imagecolorallocate()
// 3, 在指定图片上面，画一个矩形 imagefilledrectangle()
// 4, 获取随机数  (定义一个函数) get_rand_str()
//   1，定义一个字符串
//   2，将上面的字符串 打乱  str_shuffle()
//   3，并且从这个打乱的字符串当中去截取一部分内容 substr()
//   4，把截取出来的字符串转化成小写字母 strtolower()
//   5, 将这个字符串 return
// 5,将随机数写入到这个图片里面去 imagestring()
// 6,防止别人去恶意刷我们的验证码 可以在这个图片上面加上一些点 imagesetpixel()
// 7,开启session会话  将我们的验证码 存储到session当中与我们表单当中输入的验证码进行匹配
// 8,输入图片的 头信息 和 图片资源 删除 header("Content-Type:image/png"); imagepng($img); imagedestroy($img);
// 9,在登录界面 获取表单输入的验证码  和 我们session当中的验证码进行对比 如果正确就跳转登录界面 否则重新输入

function get_rand_str($length = 4)
{
    $chars = '1234567890ABCDEFGHJKLMNPQRSTUVWXYZ';
    $str = str_shuffle($chars); //随机打乱一个字符串
    $str = substr($str,0,$length);
    $str = strtolower($str);
    return $str;
}

//缩略图的宽度高度
$width = 130;
$height = 40;

//创建一张彩色的图片
$img = imagecreatetruecolor($width,$height);

//背景颜色
$backgroundcolor = imagecolorallocate($img,74,147,223);

//文字颜色
$textcolor = imagecolorallocate($img,255,255,255);

//画一矩形并填充
imagefilledrectangle($img,0,0,$width,$height,$backgroundcolor);


//获取随机字符串
$code = get_rand_str();

//水平地画一行字符串
// imagestring($img,3,35,13,$code,$textcolor);
imagettftext($img,30,0,21,32,$textcolor,$path."/assets/admin/fonts/AquaKana.ttc",$code);

//在图片当中去画一些点 防止有人而已破解验证码
for($i=0;$i<=100;$i++)
{
    $color = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    //从一个范围里面选值
    $x = mt_rand(0,$width);
    $y = mt_rand(0,$height);
    imagesetpixel($img,$x,$y,$color);
}

session_start();
$_SESSION['imgcode'] = $code;

//header("Content-Type:image/png;");

//输出图片
imagepng($img);

//把资源销毁掉
imagedestroy($img);

?>