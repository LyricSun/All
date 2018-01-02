<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/30
 * Time: 下午2:26
 */
namespace app\api\controller;

use app\common\lib\exception\ApiException;

class Newslist extends Common{

    public function index(){


        $limit = input('get.limit', 3, 'intval');
        $offset = input('get.offset', 0, 'intval');


        $cat_id = input('get.cat_id');
        $search_text = input('get.search_text');


        if ($cat_id && !$search_text){
            $cat_name = model('Cat')->getCatName($cat_id);

            $news = model('News')->getNewsListNeed($limit,$cat_id,$offset);

            for ($i = 0;$i < count($news);$i++){
                $news[$i]['cat_name'] = $cat_name[0]['name'];
            }
            return show(0,'OK',$news);
        }

        if ($search_text && !$cat_id){

            $data = model('News')->getSearchNeed($search_text,$offset,$limit);

            return show(0,'OK',$data);
        }
        if (!$cat_id && !$search_text){
            $order = model('News')->order($offset,$limit);

            return show(0,'OK',$order);
        }
        else{
            throw new ApiException('缺少请求参数',400,3003);
        }

    }
    public function read($id){

        $data = model('News')->content($id);

        return show(0,'OK',$data);
    }
}
