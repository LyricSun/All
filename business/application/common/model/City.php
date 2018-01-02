<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/8
 * Time: 下午3:46
 */

namespace app\common\model;

use think\Model;

class City extends Model{
    public function getCitiesByParentID($parent_id = 0){

        $data = [
            'status' => 1,
            'parent_id' => $parent_id
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }
}