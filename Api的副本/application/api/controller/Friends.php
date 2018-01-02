<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/29
 * Time: 上午8:19
 */
namespace app\api\controller;

use think\Controller;

class Friends extends Common {
    //返回好友列表
    public function index(){
        $friends = [
            [
                'id' => 1,
                'name' => 'tom',
                'sex' => 'man'
            ],
            [
                'id' => 2,
                'name' => 'lilei',
                'sex' => 'man'
            ],
            [
                'id' => 3,
                'name' => 'hanmeimei',
                'sex' => 'woman'
            ],
            [
                'id' => 4,
                'name' => 'zhangsan',
                'sex' => 'man'
            ],
        ];

        return show(0,'OK',$friends);
    }
    //新增一个好友
    public function save(){
        $param = input('param.');
        if (empty($param)){
            return show(0,'创建失败',$param,500);
        }
        else{
            $param['id'] = 9;
            return show(0,'OK',$param);
        }
    }
    //修改一个好友
    public function update($id){
        $put = input('put.');
        $put['id'] = $id;
        return show(0,'OK',$put);
    }
    //删除一个好友
    public function delete($id){
        $delete = input('delete.');
        $delete['id'] = $id;
        return show(0,'OK',$delete);
    }
    //查看一个好友信息
    public function read($id){
        $get = input('get.');
        $get['id'] = $id;
        return show(0,'OK',$get);
    }
}