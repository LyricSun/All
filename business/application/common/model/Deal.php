<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/13
 * Time: 上午10:12
 */
namespace app\common\model;

use think\Model;

class Deal extends Model{
    public function getDeals(){
        $data = [

        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }
    public function getDealByCondition($con_data = [])
    {
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($con_data)->order($order)->select();
    }
    public function getDealsByIdLimitCity($category_id,$limit,$se_city_id){
        $data = [
            'status' => 1,
            'category_id' => $category_id,
            'se_city_id' => $se_city_id,
        ];

        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        $result = $this->where($data)->order($order);
        if ($limit > 0){
            $result = $result->limit($limit);
        }
        $result = $result->select();

        return $result;
    }
    public function getDealsByCondition($data = [],$order_flag){
        $order = [];
        if ($order_flag == 'order_sales'){
            $order['buy_count'] = 'desc';
        }
        if ($order_flag == 'order_price'){
            $order['current_price'] = 'desc';
        }
        if ($order_flag == 'order_time'){
            $order['create_time'] = 'desc';
        }
        $order['id'] = 'desc';

        $conData[] = 'status=1';
        $conData[] = 'se_city_id =' . $data['se_city_id'];
        $conData[] = 'end_time>' . time();
        if (!empty($data['category_id'])){
            $conData[] = 'category_id=' . $data['category_id'];
        }
        if (!empty($data['se_category_id'])){
            $conData[] = 'find_in_set('. $data['se_category_id'] .',se_category_id)';
        }
        $result = $this->where(implode(' AND ',$conData))->order($order)->paginate(3);
        return  $result;
    }
}