<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/29
 * Time: 上午9:06
 */
//命名空间
namespace app\api\controller;

use app\common\lib\exception\ApiException;
use think\Controller;

//因为Friends类负责返回请求的数据,所以为了安全要先验证,common类是负责验证的,所以要继承common类
class Friends extends Common {

//返回get请求的好友列表
    //因为路由用的resource,按规定,GET请求的是index方法
    public function index(){
//测试数据
        $friends = [
            [
                'name' => 'tom',
                'age' => '28',
                'sex' => 'male'
            ],
            [
            'name' => 'lilei',
            'age' => '23',
            'sex' => 'male'
            ],
            [
                'name' => 'hanmeimei',
                'age' => '23',
                'sex' => 'female'
            ],
            [
                'name' => 'zhangsan',
                'age' => '32',
                'sex' => 'male'
            ],

        ];
        //调用封装好的show方法向前端返回请求的好友列表数据
        return show(0,'OK',$friends);
    }
    //返回post请求的好友列表
    //因为路由用的resource,按规定,POST请求的是save方法
    public function save(){
        //获取body中参数,param可获取当前请求的变量
        $param = input('param.');
        $param['id'] = 8;
        //调用封装好的show方法向前端返回加入成功
        return show(0,'OK',$param);
    }
    //返回put请求的好友列表,要带参数
    //因为路由用的resource,按规定,PUT请求的是update方法
    public function update($id){
        //获取PUT变量
        $put = input('put.');
        //把id参数加到变量put中
        $put['id'] = $id;
        //调用封装好的show方法向前端返回修改成功
        return show(0,'OK',$put);
    }
    //返回delete请求的好友列表,要带参数
    //因为路由用的resource,按规定,DELETE请求的是delete方法
    public function delete($id){
        //获取DELETE变量
        $delete = input('delete.');
        //把id参数加到变量delete中
        $delete['id'] = $id;
        //调用封装好的show方法向前端返回删除成功
        return show(0,'OK',$delete);
    }
    //返回get请求的好友列表,要带参数
    //因为路由用的resource,按规定,带参数的GET请求的是read方法
    public function read($id){
        //获取GET变量
        $get = input('get.');
        //把id参数加到变量get中
        $get['id'] = $id;
        //调用封装好的show方法向前端返回一个好友的信息
        return show(0,'OK',$get);
    }
}