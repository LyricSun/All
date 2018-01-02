<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/17
 * Time: 下午3:45
 */
namespace app\index\controller;

class Lists extends Base{

    public function index(){
        $categories = model('Category')->getCategoriesByParentIDForFront(0);
        $parent_ids = [];
        foreach ($categories as $cat){
            $parent_ids[] = $cat->id;
        }
        $data = [];

        $id = input('id',0,'intval');

        $first_id = 0;
        if (in_array($id,$parent_ids)){
            $first_id = $id;
        }
        else if ($id > 0){
            $setCat = model('Category')->get($id);
            $first_id = $setCat->parent_id;
            $data['se_category_id'] = $id;
        }
        $se_categories = [];
        if ($first_id > 0){
            $se_categories = model('Category')->getCategoriesByParentIDForFront($first_id);
        }
        $data['se_city_id'] = 11;
        $data['category_id'] = $first_id;
        $order_flag = '';
        if (input('order_sales')){
            $order_flag = 'order_sales';
        }
        if (input('order_price')){
            $order_flag = 'order_price';
        }
        if (input('order_time')){
            $order_flag = 'order_time';
        }
        $deals = model('Deal')->getDealsByCondition($data,$order_flag);
        return $this->fetch('',[
            'title' => $this->city->name . '团购',
            'categories' => $categories,
            'id' => $id,
            'se_categories' => $se_categories,
            'first_id' => $first_id,
            'flag' => $order_flag,
            'deals' => $deals
        ]);
    }
}



