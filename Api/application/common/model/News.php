<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/30
 * Time: 上午10:46
 */

namespace app\common\model;

use think\Model;

class News extends Model{


    public function getHeader($limit,$offset = 0){


        $data = [
            'is_header' => 1,
            'n.status' => 1
        ];


        return $this->alias('n')->where($data)->field('n.id,n.title,n.image,n.read_count,c.cat_name')->limit($offset,$limit)->join('__CATEGORY__ c','n.cat_id = c.id')->select();

    }



    public function getPosition($limit,$offset = 0){
        $data = [
            'is_header' => 0,
            'is_position' => 1,
            'n.status' => 1
        ];
        $order = [
            'n.id' => 'DESC'
        ];
        return $this->alias('n')->where($data)->limit($offset,$limit)->order($order)->field('n.id,title,image,read_count,cat_name')->join('__CATEGORY__ c','n.cat_id = c.id')->select();
    }


    public function getNewsListNeed($limit = 3,$cat_id,$offset){
        $data = [
            'cat_id' => $cat_id
        ];
        $order = [
            'id' => 'DESC'
        ];
        return $this->where($data)->order($order)->field('id,title,small_title,image,read_count')->limit($offset,$limit)->select();
    }

    public function getSearchNeed($search_text,$offset,$limit = 3){

        $data = [

            'small_title' => [
                'like',
                '%'.$search_text.'%'
            ],

            'status' => 1

        ];

        $order = [
            'n.id' => 'DESC'
        ];

        return $this->alias('n')
            ->where($data)
            ->order($order)
            ->field('n.id,n.title,n.small_title,n.image,n.read_count, c.name')
            ->join('__CAT__ c','n.cat_id=c.id')
            ->limit($offset,$limit)
            ->select();
    }
    public function order($offset,$limit = 3){
        $data = [
            'status' => 1
        ];
        $order = [
            'n.read_count' => 'DESC'
        ];
        return $this->alias('n')
            ->where($data)
            ->order($order)
            ->field('n.id,n.title,n.small_title,n.image,n.read_count, c.name')
            ->join('__CAT__ c','n.cat_id=c.id')
            ->limit($offset,$limit)
            ->select();
    }
    public function content($id){
        $data = [
            'status' => 1,
            'n.id' => $id
        ];
        return $this->alias('n')
            ->where($data)
            ->field('n.title,n.small_title,n.image,n.read_count,n.content,n.create_time,n.update_time,c.name')
            ->join('__CAT__ c','n.cat_id=c.id')
            ->select();
    }

}