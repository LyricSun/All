<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/13
 * Time: 上午10:08
 */
namespace app\bis\controller;

class Deal extends Base{
    public $obj;
    protected function _initialize()
    {
        parent::_initialize();
        $this->obj = model('Deal');
    }

    public function index(){
        $deals = $this->obj->getDeals();
        return $this->fetch('',[
            'deals' => $deals
        ]);
    }
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            $this->checkData('Deal','add',$data);
            $cat_string = '';
            if (!empty($data['se_categories'])){
                $cat_string = ',' . implode('|',$data['se_categories']);
            }
            $location_string = implode(',',$data['location_ids']);
            $dealData = [
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'category_path' => $data['category_id'] . $cat_string,
                'bis_id' => $this->account->bis_id,
                'location_ids' => $location_string,
                'image' => $data['image'],
                'description' => $data['description'],
                'start_time' => strtotime($data['start_time']),
                'end_time' => strtotime($data['end_time']),
                'origin_price' => $data['origin_price'],
                'current_price' => $data['current_price'],
                'city_id' => $data['city_id'],
                'total_count' => $data['total_count'],
                'coupons_begin_time' => strtotime($data['coupons_begin_time']),
                'coupons_end_time' => strtotime($data['coupons_end_time']),
                'bis_account_id' => $this->account->id,
                'notes' => $data['notes'],
                'city_path' => $data['city_id'] . $data['se_city_id'],
                'se_category_id' => empty($cat_string) ? '' : substr($cat_string,1),
                'se_city_id' => $data['se_city_id']
            ];
            if (isset($data['id'])){

                $res = $this->obj->save($dealData,['id' => $data['id']]);
            }
            $res = $this->obj->save($dealData);
            if (!$res){
                $this->error('添加失败');
            }
            else{
                $this->success('添加成功');
            }
        }
        $provinces = model('City')->getCitiesByParentID();
        $categories = model('Category')->getCategoriesByParentID();
        $shops = model('BisLocation')->getLocationsByBisID($this->account->bis_id);
        return $this->fetch('',[
            'provinces' => $provinces,
            'categories' => $categories,
            'shops' => $shops
        ]);
    }
    public function detail(){
        $id = input('id',0,'intval');
        $deal = $this->obj->get($id);
        $provinces = model('City')->getCitiesByParentID();
        $cities = model('City')->getCitiesByParentID(intval($deal['city_id']));
        $se_city_id = $deal['se_city_id'];
        $categories = model('Category')->getCategoriesByParentID();
        $shops = model('BisLocation')->getLocationsByBisID($this->account->bis_id);
        $locationArray = [];
        if ($deal['location_ids']){
            $locationArray = explode(',',$deal['location_ids']);
        }
        return $this->fetch('',[
            'deal' => $deal,
            'provinces' => $provinces,
            'categories' => $categories,
            'shops' => $shops,
            'cities' => $cities,
            'se_city_id' => $se_city_id,
            'locationArray' => $locationArray
        ]);

    }
}