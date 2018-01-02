<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/20
 * Time: 下午2:38
 */
//封装
function show($status, $message, $data = array())
{
    //定义一个数组
    $result = array(
        'status' => $status,
        'message' => $message,
        'data' => $data
    );
    //exit的作用是在调用的时候停止后台脚本,将数据传给前端,json_encode是将()里的数组以对象的形式传回
    exit(json_encode($result));
}

//封装,当调用时返回一个md5格式的密码
function getMd5Password($password)
{
    //C('')的意思是C方法,模块下的控制器可以直接用C获取自己的配置,先看当前控制器下的config，再看公共的.之所以加C,是为了让密码安全性更高
    return md5($password . C('MD5_PRE'));
}

function getMenuType($type)
{
    return ($type == 1) ? '后台' : '前端索引';
}

function status($status)
{
    if ($status == -1) {
        return $str = '删除';
    }
    if ($status == 1) {
        return $str = '正常';
    }
    if ($status == 0) {
        return $str = '关闭';
    }
}

//点击哪个
function getMenuUrl($navo)
{
    return "/admin.php?c=" . $navo['c'] . "&a=" . $navo['f'];
}


//点击每个controller时,会将对应的控制器点亮
function getContrllerName($navo)
{
    $c = strtolower(CONTROLLER_NAME);
    if (strtolower($navo) == $c) {
        return 'class="active"';
    }
    return '';
}

function isThumb($thumb)
{
    return ($thumb) ? '有' : '无';

}

function getCopyFromById($id)
{
    return C('COPY_FROM')[$id];


}

function getCatName($catid)
{
    $res = D('Menu')->getName($catid);
     return $res;



}