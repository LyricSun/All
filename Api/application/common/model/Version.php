<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/1
 * Time: 下午2:25
 */
namespace app\common\model;

use think\Model;

class Version extends Model{
    public function getLatestVersion($app_type){
        $data = [
            'status' => 1,
            'app_type' => $app_type
        ];
        $order = [
            'id' => 'DESC'
        ];
        return $this->where($data)->order($order)->field('version_name,upgrad_point,apk_url')->find();
    }
}