<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/15
 * Time: 下午3:00
 */
namespace app\index\controller;

use think\Controller;
use think\Session;

class Base extends Controller{
    public $account;
    public $city;
    protected function _initialize(){
        $hotCities = model('City')->getCitiesByParentID(['neq',0]);
        $this->getCurrentCity();
        $this->assign('hotCities',$hotCities);
        $this->account = session('user','','o2o');
        $this->assign('user',$this->account);
        $this->assign('city',$this->city);
        $this->assign('controller',strtolower(request()->controller()));
    }
    public function getCurrentCity(){
        $defaultCity = model('City')->get(['is_default' => 1]);
        if (input('city_uname')){
            $uname = input('city_uname',$defaultCity->uname,'trim');
            $current_city = model('City')->get(['uname' => $uname]);
            session('curr_city',$current_city,'o2o');
        }
        else{
            if (Session::get('curr_city','o2o')){
                $current_city = Session::get('curr_city','o2o');
            }
            else{
                $current_city = $defaultCity;
                session('curr_city',$current_city,'o2o');
            }
        }
        $this->city = $current_city;
        return $current_city;
    }
    public function getHotCategories(){
        //所有一级分类id
        $parentIDs = [];
        $seArray = [];
        $recommandArray = [];
        //获取所有一级分类:
        $categories = model('Category')->getCategoriesByParentIDWithLimit(0,5);
        foreach ($categories as $cat)
        {
            $parentIDs[] = $cat->id;
        }
        //根据ids获取二级分类
        $seCategories = model('Category')->getSeCategoriesByParentIDs($parentIDs);
        foreach ($seCategories as $se_cat){
            $seArray[$se_cat->parent_id][] = [
                'id' => $se_cat->id,
                'name' => $se_cat->name
            ];
        }
        foreach ($categories as $cat){
            $recommandArray[$cat->id] = [$cat->name,empty($seArray[$cat->id])?[]:$seArray[$cat->id]];
        }
        return $recommandArray;
    }
}