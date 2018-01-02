<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/15
 * Time: 上午9:57
 */
namespace app\common\model;

use think\Model;

class Featured extends Model{
    public function getAllFeatured(){
        $data = [

        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }
    public function getAllFeaturedByCondition($con_data = [])
    {
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($con_data)->order($order)->select();
    }
}