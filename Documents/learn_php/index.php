<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/17
 * Time: 下午2:09
 */

include 'db.php';  //导入 db.php文件

session_start();  //开启 session
if (!$_SESSION['user']){

    jumpTo('login');  //跳转到login页面

}


include 'templates/index.php';  //导入templates/index.php文件