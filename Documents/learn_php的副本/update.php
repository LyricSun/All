<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/18
 * Time: 下午4:31
 */

include 'db.php';

if($_GET){

    $id = $_GET['userID'];

    $dbc = mysqli_connect(DB_POST,DB_USER,DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error('连接失败'));

    $sql = "SELECT * FROM person WHERE id = $id";

    $result = mysqli_query($dbc,$sql);

    $data = array();

    if (mysqli_num_rows($result)){

        $data = mysqli_fetch_array($result);

    }

}

if ($_POST){

    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $id = $_POST['userID'];

    if (!empty(trim($username)) && !empty(trim($gender)) && !empty(trim($phone))){



        $dbc = mysqli_connect(DB_POST,DB_USER,DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error('链接失败'));

        $sql = "UPDATE if_php.person SET per_name = '$username', per_gender = '$gender', per_tel = '$phone' WHERE id = $id";

        $result = mysqli_query($dbc,$sql);

        if ($result){

            jumpTo('index');
            echo '<script>alert("修改成功")</script>';

        }
        else{

            echo '<script>alert("修改失败")</script>';

        }

    }
    else{

        echo '<script>alert("每一项信息都不能为空")</script>';

    }


}





include 'templates/update.php';

