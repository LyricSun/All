<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/17
 * Time: 下午3:46
 */

include 'db.php'; //导入db.php文件

session_start();  //开启session

unset($_SESSION['user']);  //释放session变量

jumpTo('login');  //跳转到login页面



