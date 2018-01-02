<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    //当验证完用户名和密码时进入到此方法,将index文件下的index.html展示出来
    public function index(){
         $this->display();
    }


}