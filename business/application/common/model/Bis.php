<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/9
 * Time: 下午7:58
 */
namespace app\common\model;

use think\Model;

class Bis extends Model{
    public function add($data = []){
        $data['status'] = 1;
        $this->save($data);
        return $this->id;
    }
    public function getBisByStatus($status = 0){
        $data = [
            'status' => $status
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->paginate(5);
    }
}