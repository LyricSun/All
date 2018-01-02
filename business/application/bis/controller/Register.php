<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/8
 * Time: 下午3:17
 */
namespace app\bis\controller;

use think\Controller;

class Register extends Controller{
    public function index(){
        $provinces = model('City')->getCitiesByParentID();
        $categories = model('Category')->getCategoriesByParentID();
        return $this->fetch('',[
            'provinces' => $provinces,
            'categories' => $categories
        ]);
    }

    public function get_se_cities(){
        if (request()->isPost()){
            $parent_id = input('parent_id',0,'intval');
            $cities = model('City')->getCitiesByParentID($parent_id);
            if (!$cities){
                $this->result('',0,'获取城市失败');
            }
            else{
                $this->result($cities,1,'获取城市成功');
            }
        }
    }
//    public function child_cg(){
//        if (request()->isPost()){
//            $parent_id = input('parent_id',0,'intval');
//            $categories = model('Category')->getCategoriesByParentID($parent_id);
//            $this->assign('childCategories',$categories);
//        }
//
//    }

    public function get_se_categories(){
        $parent_id = input('parent_id',0,'intval');
        $res = model('Category')->getCategoriesByParentID($parent_id);
        if (!$res && !is_array($res)){
            $this->result('',0,'获取分类失败');
        }
        else{
            $this->result($res,1,'获取分类成功');
        }
    }
    public function add(){
        if (request()->isPost()){
            $data = input('post.');

//            print_r($data);exit();


            $this->checkData('BisAccount','add',$data);
            $res = model('BisAccount')->get(['username' => $data['username']]);
            if ($res){
                $this->error('用户名已存在');
            }
            $this->checkData('Bis','add', $data);

            $locationResult = \Map::getLngLat($data['address']);
            if ($locationResult['status'] != 0 || $locationResult['result']['precise'] != 1){
                $this->error('商户地址信息不准确');
            }
            $bisData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'logo' => $data['logo'],
                'licence_logo' => $data['licence_logo'],
                'description' => $data['description'],
                'city_id' => $data['city_id'],
                'city_path' => $data['city_id'].','.$data['se_city_id'],
                'bank_info' => $data['bank_info'],
                'bank_name' => $data['bank_name'],
                'bank_user' => $data['bank_user'],
                'faren' => $data['faren'],
                'faren_tel' => $data['faren_tel']
            ];
            $bis_id = model('Bis')->add($bisData);
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
                'bis_id' => $bis_id,
                'open_time' => $data['open_time'],
                'content' => $data['content'],
                'is_main' => 1,
                'api_address' => $data['address'],
                'city_id' => $data['city_id'],
                'city_path' => $bisData['city_path'],
                'category_id' => $data['category_id'],
                'category_path' => $data['category_id'] . $cat_string,
                'bank_info' => $data['bank_info']
            ];
            $location_res = model('BisLocation')->save($locationData);
            $code = mt_rand(1000,9999);
            $accountData = [
                'username' => $data['username'],
                'password' => md5($data['password'] . $code),
                'code' => $code,
                'bis_id' => $bis_id,
                'is_main' => 1
            ];
            $account_res = model('BisAccount')->save($accountData);
            if ($bis_id && $location_res && $account_res){
                $this->success('注册成功',url('login/index'));
            }
            else{
                $this->error('注册失败');
            }
        }

    }
    public function checkData($className,$scene,$data = []){
        $validate = validate($className);
        $res = $validate->scene($scene)->check($data);
        if (!$res){
            return $this->error($validate->getError());
        }
        return true;
    }
}