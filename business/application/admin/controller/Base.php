<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/14
 * Time: 上午9:33
 */
namespace app\admin\controller;

use think\Controller;

class Base extends Controller{
    public $account;

    protected function _initialize(){
        $isLogin = $this->checklogin();
        if (!$isLogin){
            $this->redirect('login/index');
        }
        $this->assign('username',$this->account->username);
    }

    public function checklogin(){
        $user = $this->getCurrentAdmin();
        if (!$user){
            return false;
        }
        return true;
    }

    public function getCurrentAdmin(){
        if (!$this->account){
            $this->account = session('admin_user','','o2o');
            return $this->account;
        }
    }
    /**
     * 实现数据校验
     */
    public function checkData($className, $scene, $data = []){
        $validate = validate($className);
        $res = $validate->scene($scene)->check($data);
        if (!$res)
        {
            return $this->error($validate->getError());
        }
        return true;
    }

    /**
     * 修改状态的函数
     */
    public function status()
    {
        //接收从前端发送过来的status值
        $status = input('status', 0, 'intval');
        $id = input('id', 0, 'intval');
        $modelName = input('model');//想要修改的表名
        //修改数据库的值 参数1是修改的值 参数2是条件
        $res = model($modelName)->save(['status' => $status], ['id' => $id]);
        if (!$res)
        {
            $this->error('状态修改失败');
        }
        else
        {
            $this->success('状态修改成功');
        }
    }

    /**
     * 根据common.js发过来的parent_id，查询下属城市
     */
    public function get_se_cities()
    {
        if (request()->isPost())
        {
            $parent_id = input('parent_id', 0, 'intval');

            //根据parent_id查询二级城市信息
            $cities = model('City')->getCitiesByParentID($parent_id);
            if (!$cities)
            {
                $this->result('', 0, '获取城市失败');
            }
            else
            {
                //结果返回到js请求处
                $this->result($cities, 1, '获取城市成功');
            }
        }
    }

    /**
     * 根据一级分类的id，查询其所有子分类，由common.js使用
     */
    public function get_se_categories()
    {
        $parent_id = input('parent_id', 0, 'intval');
        $res = model('Category')->getCategoriesByParentID($parent_id);
        if (!is_array($res))
        {
            $this->result('', 0, '获取分类失败');
        }
        else
        {
            $this->result($res, 1, '获取分类成功');
        }
    }

}
