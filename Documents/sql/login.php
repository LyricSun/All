<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/20
 * Time: 上午11:01
 */

$email2 = $_POST['email'];
$password2 = $_POST['password'];

$db2 = mysqli_connect('127.0.0.1','root','123456','demo') or die(mysqli_connect_error('11111'));

////--------------------------------------------------------//

$sql2 = "SELECT id FROM user WHERE email = '$email2'";
//var_dump($sql2);exit();
$db_query = mysqli_query($db2,$sql2);

//if ($db_query){
//    $sql3 = "SELECT password FROM user WHERE email = '$email2'";
////    var_dump($sql3);exit();
//    $db_query2 = mysqli_query($db2,$sql3);
//    $res = mysqli_fetch_array($db_query2);
////    var_dump($res);exit();
//    if ($res[0] == $password2){
//
//        echo '<script>alert("登录成功");location.href = "https://www.baidu.com/";</script>';
//
//    }
//    else{
//        echo '<script>alert("登录失败")</script>';
//    }
//}
//else{
//    echo '<script>alert("用户名不存在")</script>';
//}

////-------------------------------------------------------------//

$sql2 = "SELECT id FROM user WHERE email = '$email2' AND password = '$password2'";
//var_dump($sql2);exit();
$db_query2 = mysqli_query($db2,$sql2);
$res = mysqli_num_rows($db_query2);
if ($res){
    echo '<script>alert("登录成功")</script>';
}
else{
    echo '<script>alert("登录失败")</script>';
}