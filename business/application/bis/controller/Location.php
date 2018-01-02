<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/10
 * Time: 上午9:36
 */
namespace app\bis\controller;

class Location extends Base{
    public function index(){
        $location = model('BisLocation')->getLocationsByBisID($this->account->bis_id);
        return $this->fetch('',[
            'locations' => $location
        ]);
    }
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            $this->checkData('BisLocation','add', $data);
            $locationResult = \Map::getLngLat($data['address']);
            if ($locationResult['status'] != 0 || $locationResult['result']['precise'] != 1){
                $this->error('商户地址信息不准确');
            }

            $se_cats = $data['se_categories'];
            $cat_string = '';
            if (!empty($se_cats)){
                $cat_string = ',' . implode('|',$se_cats);
            }

            $locationData = [
                'name' => $data['name'],
                'logo' => $data['logo'],
                'address' => $data['address'],
                'tel' => $data['tel'],
                'contact' => $data['contact'],
                'xpoint' => $locationResult['result']['location']['lng'],
                'ypoint' => $locationResult['result']['location']['lat'],
                'bis_id' => $this->account->bis_id,
                'open_time' => $data['open_time'],
                'content' => $data['content'],
                'is_main' => 0,
                'api_address' => $data['address'],
                'city_id' => $data['city_id'],
                'city_path' => $data['city_id'] . ',' . $data['se_city_id'],
                'category_id' => $data['category_id'],
                'category_path' => $data['category_id'] . $cat_string
            ];
            if (isset($data['id'])){
                $res = model('BisLocation')->save($locationData,['id' => $data['id']]);
                if (!$res){
                    $this->error('更新失败');
                }
                else{
                    $this->success('更新成功');
                }
            }

            $location_res = model('BisLocation')->save($locationData);
            if (!$location_res){
                $this->error('新增失败');
            }
            else{
                $this->success('新增成功');
            }
        }
        $provinces = model('City')->getCitiesByParentID();
        $categories = model('Category')->getCategoriesByParentID();
        return $this->fetch('',[
            'provinces' => $provinces,
            'categories' => $categories
        ]);
    }
    public function detail(){
        $id = input('id',0,'intval');
        $res = model('BisLocation')->get($id);
        $provinces = model('City')->getCitiesByParentID();
        $cities = model('City')->getCitiesByParentID(intval($res['city_id']));
        $se_city_id = explode(',',$res['city_path'])[1];
        $categories = model('Category')->getCategoriesByParentID();
        return $this->fetch('',[
            'location' => $res,
            'provinces' => $provinces,
            'categories' => $categories,
            'cities' => $cities,
            'se_city_id' => $se_city_id
        ]);

    }
}