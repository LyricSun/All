<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/9
 * Time: 下午2:11
 */

function show($status,$msg){

    $arr = array(

        'status' => $status,
        'msg' => $msg

    );

    echo json_encode($arr);

}