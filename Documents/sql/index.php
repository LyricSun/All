<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/20
 * Time: 上午9:36
 */

$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

$db = mysqli_connect('127.0.0.1','root','123456','demo') or die(mysqli_connect_error('11111'));
//var_dump($db);exit();
$sql = "INSERT INTO demo.user(name, password, email)  VALUE ('".$name."','".$password."','".$email."')";
//echo $sql;exit();
$db_in = mysqli_query($db, $sql);
//var_dump($db_in);exit();
if ($db_in){
    echo '<script>alert("注册成功")</script>';
}
else{
    echo '<script>alert("注册失败")</script>';
}


