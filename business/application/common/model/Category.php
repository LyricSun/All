<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/6
 * Time: 下午4:52
 */
namespace app\common\model;

use think\Model;

class Category extends Model{
    public function getCategoriesByParentID($parent_id = 0){
        $data = [
//            'status' => 1,
            'parent_id' => $parent_id
        ];

        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];

        return $this->where($data)->order($order)->select();
    }

    public function getCategoriesByParentIDForPage($parent_id = 0){
        $data = [
//            'status' => 1,
            'parent_id' => $parent_id
        ];

        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];

        return $this->where($data)->order($order)->paginate(3);
    }
    public function getCategoriesByParentIDWithLimit($parent_id = 0, $limit = 5)
    {
        //条件
        $data = [
            'status' => 1,
            'parent_id' => $parent_id
        ];
        //排序方式
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        $result = $this->where($data)->order($order);
        if ($limit)
        {
            $result = $result->limit($limit);
        }
        return $result->select();
    }
    public function getSeCategotiesByParentIDs($parent_ids = []){
        $data = [
            'status' => 1,
            'parent_id' => ['in',implode(',',$parent_ids)]
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

    public function getCategoriesByParentIDForFront($parent_id = 0){
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