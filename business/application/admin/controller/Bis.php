<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/14
 * Time: 上午11:14
 */
namespace app\admin\controller;

class Bis extends Base{
    private $obj;
    protected function _initialize()
    {
        parent::_initialize();
        $this->obj = model('Bis');
    }
    public function index(){
        $bis = $this->obj->getBisBystatus(1);
        return $this->fetch('',[
            'bis' => $bis
        ]);
    }
    public function apply(){
        $bis = $this->obj->getBisBystatus(0);
        return $this->fetch('',[
            'bis' => $bis
        ]);
    }

    public function dellist(){
        $bis = $this->obj->getBisBystatus(-1);
        return $this->fetch('',[
            'bis' => $bis
        ]);
    }
    /**
     * 商铺详情方法
     */
    public function detail()
    {
        $id = input('id', 0, 'intval');
        //从Bis表获取基本信息:
        $bisData = $this->obj->get($id);
        $locationData = model('BisLocation')->get(['bis_id' => $id]);
        //根据条件查询某个字段的值
        $username = model('BisAccount')->where(['bis_id' => $id])->value('username');
        //获取一级城市
        $provinces = model('City')->getCitiesByParentID();
        //获取一级分类
        $categories = model('Category')->getCategoriesByParentID();
        //根据city_path获取二级城市id和二级城市信息
        $cities = model('City')->getCitiesByParentID(intval($bisData['city_id']));
        $se_city_id = explode(',', $bisData['city_path'])[1];
        return $this->fetch('', [
            'bisData' => $bisData,
            'locationData' => $locationData,
            'provinces' => $provinces,
            'categories' => $categories,
            'cities' => $cities,
            'se_city_id' => $se_city_id,
            'username' => $username
        ]);
    }
}