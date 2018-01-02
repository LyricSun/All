<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/27
 * Time: 上午9:56
 */
namespace app\api\controller;

use app\common\lib\exception\ApiException;
use think\Controller;
use think\Exception;

class Friends extends Common {
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


        return data_return(0,'OK',$friends);

    }
    public function test(){
//        throw new Exception('错误',400);
        throw new ApiException('错误',400);
    }

    public function save(){
        $param = input('param.');

        $param['id'] = 5;
        return data_return(0,'创建好友失败',$param,500);
    }
    public function update($id){
        $put = input('put.');
        $put['id'] = $id;
        return data_return(0,'OK',$put);
    }
    public function delete($id){
        $delete = input('delete.');
        $delete['id'] = $id;
        return data_return(0,'OK',$delete);
    }
    public function read($id){
        $get = input('get.');
        $get['id'] = $id;
        return data_return(0,'OK',$get);
    }


}














