<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/9
 * Time: 下午8:19
 */
namespace app\common\model;

use think\Model;

class BisLocation extends Model{
    public function getLocationsByBisID($bis_id){
        $data = [
            'bis_id' => $bis_id
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        $result = $this->where($data)->order($order)->select();

        return $result;
    }
}