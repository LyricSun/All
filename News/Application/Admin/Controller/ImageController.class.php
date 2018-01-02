<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/30
 * Time: 上午11:18
 */
namespace Admin\Controller;
use Think\Controller;

class ImageController extends Controller{

    public function ajaxuploadimage(){
      $upload= D('Uploadimage');
      $res = $upload->imageUpload();
      if ($res == false) {
          return show(0,'上传失败');
      } else {
          return show(1,'上传成功',$res);
      }


    }
}