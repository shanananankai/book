<?php
/**
 * 函数类
 */
class FUN {
    //构造函数 在对象实例化的时候，自动调用的一个方法
    public function __construct()
    {

    }

    public function p($star){
        echo '<pre style="background: rgba(255,204,204,.5);color: #FF6633;">';
        print_r($star);
        echo '</pre>';
        exit;
    }





}

?>