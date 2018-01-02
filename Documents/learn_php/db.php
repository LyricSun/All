<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/9/29
 * Time: 上午10:04
 */

define('DB_HOST','127.0.0.1'); //定义一个名字为 DB_HOST , 值为 127.0.0.1 的常量
define('DB_USER','root');  //定义一个名字为 DB_USER , 值为 root 的常量
define('DB_PASSWORD','123456');  //定义一个名字为 DB_PASSWORD , 值为 123456 的常量
define('DB_DATABASE','if_php');  //定义一个名字为 DB_DATABASE , 值为 if_php 的常量

define('FI_BASE','http://localhost/learn_php/'); //定义一个名字为 FI_BASE , 值为 http://localhost/learn_php/ 的常量

function jumpTo($desFile){  //定义一个名为 jumpTo ,参数为 $desFile 的函数

    header('location:'.FI_BASE.$desFile.'.php');  //调用header函数实现跳转

}