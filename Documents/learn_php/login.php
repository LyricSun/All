<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/9/29
 * Time: 上午11:00
 */


include 'db.php';//导入 db.php 文件

session_start(); //开启 session
if($_SESSION['user']){ // 如果名为user的session变量中有值

    jumpTo('index'); //跳转到 index 页面

}

if($_POST){ // 如果从表单获取到值

    $username = $_POST['username'];  //把通过名为username获取到的值存在变量$username中
    $password = $_POST['password'];  //把通过名为password获取到的值存在变量$password中


    if (!empty(trim($username)) && !empty(trim($password))) { //判断如果账户名和密码都不为空

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysqli_connect_error('连接失败'));  //建立数据库链接,存在变量$dbc中

        $pass_md5 = md5($password);  //把密码通过md5算法加密

        $sql = "SELECT username FROM user WHERE username = '$username' AND password = '$pass_md5'";  //把查询账户和密码的sql语句存在变量$sql中

        $result = mysqli_query($dbc,$sql);  //调用函数mysqli_query,根据传入的参数$dbc和$sql查询,把查询结果存在变量$result中

        if (mysqli_num_rows($result)){  //把参数$result传给函数mysqli_num_rows,如果有值

            session_start(); //开启 session

            $_SESSION['user'] = $username;  //把变量$username中的值赋给名字是user的session变量

            jumpTo('index'); //跳转到 index页面

        }
        else{ //否则

            echo '<script>alert("账户名或密码错误")</script>'; // 以弹窗形式输出错误提示

        }

    }
    else{  //否则

        echo '<script>alert("账户名或密码为空")</script>'; //以弹窗形式输出错误提示

    }

}

include 'templates/login.php'; //导入视图文件 templates/login.php
