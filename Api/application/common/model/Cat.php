<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/29
 * Time: 下午3:51
 */
//命名空间
namespace app\common\model;
//是用类
use think\Model;
//因为要对数据库数进行操作,所以继承model类
class Cat extends Model{
    //从cat表查询所有数据
    public function getCat(){
        //返回查询的数据
        return $this->select();
    }
    public function getCatName($cat_id){
        $data = [
            'id' => $cat_id
        ];

        return $this->where($data)->field('name')->select();
    }
}