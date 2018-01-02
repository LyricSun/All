<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/11
 * Time: 上午10:56
 */


$username = $_POST['username'];
$password = $_POST['password'];

$dbc = mysqli_connect('127.0.0.1','root','123456','demo')
or die('Error to connect MySQL');


$query = "select username,password from account";

$result = mysqli_query($dbc,$query) or die('error to query');

$num = mysqli_num_rows($result);

$row = mysqli_fetch_assoc($result);

//var_dump($row);

$query_name = "select username from account";
$query_pass = "select password from account";

$name = mysqli_query($dbc,$query_name) or die('error to query');
$pass = mysqli_query($dbc,$query_pass) or die('error to query');

$usern = mysqli_fetch_array($name);
$passw = mysqli_fetch_array($pass);

for ($i = 0;$i < count($usern);$i++){

    if ($username == $usern){

        for ($i = 0;$i < count($passw);$i++){

            if ($password == $passw){

            show(1,'登录成功');

        }
        else{

            show(0,'密码错误');

        }
        }

    }
    else{

        show(0,'用户名不存在');

    }

}






