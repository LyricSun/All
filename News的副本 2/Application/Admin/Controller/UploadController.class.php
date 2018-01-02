<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/30
 * Time: 上午11:18
 */
namespace Admin\Controller;
use Think\Controller;
class UploadController extends Controller{
    public function index(){
        $upload = D('Upload');
        $res = $upload->upload_two();
        if ($res === false){
            return show(0,'上传失败');
        }
        else{
            return show(1,'上传成功',$res);
        }
    }
}