<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/21
 * Time: 下午4:44
 */
function show($status,$message,$data=array()){
    $result = array(
        'status' => $status,
        'message' => $message,
    );
    exit(json_encode($result));
}
function GetMd5Password($password){
    return md5($password.C('MD5_PRE'));
}

function getMenuType($type){
    return ($type == 1) ? '后台菜单' : '前端索引';
}

function status($status){
    if($status == 0) {
        $str = '关闭';
    }else if($status == 1) {
        $str = '正常';
    }else if($status == -1) {
        $str = '删除';
    }
    return $str;
}
function getActive($navc){
    $c = strtolower(CONTROLLER_NAME);
    if(strtolower($navc) == $c) {
        return 'active';
    }
    return '';
}
function getAdminMenuUrl($nav) {
    $url = '/admin.php?c='.$nav['c'].'&a='.$nav['a'];

    return $url;
}
function getCatName($catid){
    $menu = D('Menu')->getIdAndName();

    for ($i = 0;$i < count($menu);$i++){
        if ($catid == $menu[$i]['menu_id']){
            $catid = $menu[$i]['name'];
        }

    }
    return $catid;
}
function getCopyFromById($copyid){
    $from = C('COPY_FROM');
    for ($i = 0;$i < count($from);$i++){
        if ($copyid == $i){
            $copyid = $from[$i];
        }
    }

    return $copyid;
}
function isThumb($thu){
    if ($thu['thumb']){
        return '有';
    }
    else{
        return '无';
    }

}
