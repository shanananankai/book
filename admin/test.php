<?php

if ($_POST){
var_dump($_POST);
exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>图片上传预览</h1>
<form method="post" action="" >
    <input type="text"  name="aaw" multiple />
    <input type="file" id="demo" name="aa" multiple />
    <input class="btn btn-primary" type="submit" value="提交" />
</form>
<div id="view"></div>
</body>
</html>
<script>
    var demo = document.getElementById("demo");
    var view = document.getElementById("view");

    //FileReader js的内置对象 读取文件内容
    if(typeof FileReader === 'undefined')
    {
        alert("当前浏览器不支持FileReader对象");
    }else{
        demo.addEventListener('change',readFile);
    }

    function readFile()
    {
        //拿到input元素当中所选择所有图片
        var file = this.files;
        if(file.length>=1){
            view.innerHTML = "";
        }
        for(var i=0;i<file.length;i++)
        {
            var that = file[i];
            //只是上传图片类型
            if(!/image\/\w+/.test(that.type))
            {
                alert("请选择图片类型");
                return false;
            }

            //新建一个js文件读取的对象
            var reader = new FileReader();
            //加载一个读取的对象
            reader.readAsDataURL(that);

            //先读取文件，然后读取完之后会触发onload事件
            reader.onload = function(){
                var img = document.createElement("img");
                console.log(img);
                img.src = this.result;
                view.appendChild(img);
            }



        }

    }

</script>