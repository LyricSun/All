<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/29
 * Time: 下午3:26
 */
//命名空间
namespace app\api\controller;
//使用类
use app\common\lib\exception\ApiException;
use think\Controller;

//cat类继承common类
class Cat extends Common {

    //返回给前端分类列表
    //因为路由用的resource,按规定,GET请求的是index方法
    public function index(){
        //从数据库获取数据,通过Cat的model中的getCat方法获取数据
        $cat = model('Cat')->getCat();

        //判断是否获取到了数据,如果未获取到,那么抛出异常,因为是未找到资源,所以状态码应该用404
        if (!$cat) {
            throw new ApiException('未获取到',404);
        }
        //调用封装好的show方法向前端返回请求的分类列表数据
        return show(0,'OK',$cat);
    }
}