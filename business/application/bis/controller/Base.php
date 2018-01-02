<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/7
 * Time: 下午3:53
 */
namespace app\bis\controller;

use think\Controller;
use think\Session;

class Base extends Controller{
    public $account = '';

    protected function _initialize(){

        if(!$this->checkLogin()){
            $this->redirect('login/index');
        }
        $this->assign('user',$this->account);
    }
    public function checkLogin(){
        $user = $this->getCurrentUserInfo();
        if (!$user){
            return false;
        }
        return true;
    }

    public function getCurrentUserInfo(){
        if(!$this->account){
            $this->account = Session::get('bis_user','o2o');
        }
        return $this->account;
    }
    public function checkData($className,$scene,$data = []){
        $validate = validate($className);
        $res = $validate->scene($scene)->check($data);
        if (!$res){
            return $this->error($validate->getError());
        }
        return true;
    }

    public function status(){
        $status = input('status',0,'intval');
        $id = input('id',0,'intval');
        $modelName = input('model');
        $res = model($modelName)->save(['status' => $status],['id' => $id]);
        if (!$res){
            $this->error('状态修改失败');
        }
        else{
            $this->success('状态修改成功');
        }
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
}