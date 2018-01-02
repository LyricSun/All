<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/9
 * Time: 上午9:57
 */
namespace app\api\controller;

use think\Controller;
use think\Request;

class Image extends Controller{
    public function upload(){
        $file = Request::instance()->file('file');

        $info = $file->move('upload');
        if ($info && $info->getPathname()){
            return show(1,'上传成功','/'.$info->getPathname());
        }
        return show(0,'上传失败','');
    }
}