<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/28
 * Time: 下午2:01
 */
//命名空间
namespace app\api\controller;
//使用类
use think\Controller;
//Time类继承Controller类
class Time extends Controller{
//返回给服务器时间,因为客户端的时间很可能与系统时间不一致
    //因为路由用的resource,按规定,GET请求的是index方法
    public function index(){
        //调用封装好的show方法向前端返回请求的服务器时间
        return data_return(0,'OK',['server_time' => time()]);
    }
}