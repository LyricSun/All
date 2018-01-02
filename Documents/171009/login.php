<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/9/29
 * Time: 上午11:00
 */

//var_dump($_POST);

require_once 'function.php';


$username = $_POST['username'];
$password = $_POST['password'];


$dbc = mysqli_connect('127.0.0.1','root','123456','demo')
or die('Error to connect MySQL');

$query_name = "select username,password from account WHERE username = '" . $username . "'";


$name = mysqli_query($dbc,$query_name) or die('error to query');


$usern = mysqli_num_rows($name);

$result = mysqli_fetch_array($name);

if ($usern == 1){



    if ($password == $result['password']){

            show(1,'登录成功');

    }
    else{

            show(0,'密码错误');

    }

}
else{

    show(0,'用户名不存在');

}


