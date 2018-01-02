<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/20
 * Time: 下午4:05
 */
namespace app\index\controller;

class Detail extends Base{
    public function index(){
        $id = input('id',0,'intval');
        if(!$id){
            $this->error('商品ID异常');
        }
        $deal = model('Deal')->get($id);
        $catName = model('Category')->where(['category_id'=>$deal->category_id])->value('name');
        $bis_name = model('BisAccount')->where(['bis_id'=>$deal->bis_id])->value();
        $locations = [];
        foreach (explode(',',$deal->location_ids) as $id){
            $locations[] = model('BisLocation')->get($id);
        }

        return $this->fetch('',[
            'title' => $this->city->name . '团购',
            'cat_name' => $catName,
            'bis_name' => $bis_name,
            'deal' => $deal,
            'locations' => $locations
        ]);
    }
}