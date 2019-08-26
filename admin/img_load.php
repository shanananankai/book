<?php
include_once("../includes/init.php");
include_once("public/common.php");

if (!$_GET['collect']){
   jump('你要看什么???');
}
$collect = $_GET['collect'];
$book_id = $_GET['book_id'];

$book_data = $db->select()->from("book")->where("id={$book_id}")->find();

$url = './collection/'.$book_data['title'].'/'.$collect.'/';

$sum = count(scandir($url))-2;

?>

<!DOCTYPE html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $book_data['title'].$collect?>
    </title>
</head>
<body>
    <?php for ($x=1; $x<=$sum; $x++) {?>
        <img class="lazy" src="<?php echo $url.$x?>.webp" style="width: 70%;margin: 30px 15% 0 15%;">
    <?php }?>
</body>
</html>
