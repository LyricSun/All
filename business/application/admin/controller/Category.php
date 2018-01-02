<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/6
 * Time: 下午3:33
 */
namespace app\admin\controller;

use think\Controller;

class Category extends Base {
    private $obj;
    protected function _initialize(){
        $this->obj = model('Category');
    }

    public function index(){
        $parent_id = input('parent_id',0,'intval');

        $res = $this->obj->getCategoriesByParentIDForPage($parent_id);
        return $this->fetch('',[
            'categories' => $res,
            'flag' => $parent_id
        ]);
    }

    public function status(){
        $status = input('status',0,'intval');
        $id = input('id',0,'intval');
        $res = $this->obj->save(['status' => $status],['id' => $id]);
        if (!$res){
            $this->error('状态修改失败');
        }
        else{
            $this->success('状态修改成功');
        }
    }

    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            $validate = validate('Category');
            $res = $validate->scene('add')->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            $res = $this->obj->get([
                'parent_id' => $data['parent_id'],
                'name' => $data['name']
            ]);
            if ($res){
                $this->error('该分类已存在');
            }

            $res = $this->obj->save($data);
            if (!$res){
                $this->error('添加分类失败');
            }
            else{
                $this->success('添加分类成功');
            }
        }

        $categories = $this->obj->getCategoriesByParentID();
        return $this->fetch('',[
            'categories' => $categories
        ]);
    }
    public function edit(){
        if (request()->isPost()){
            $data = input('post.');
            $validate = validate('Category');
            $res = $validate->scene('add')->check($data);
            if (!$res){
                $this->error($validate->getError());
            }
            $res = $this->obj->save($data,['id'=>$data['id']]);
            if (!$res){
                $this->error('更新失败');
            }
            else{
                $this->success('更新成功');
            }
        }

        $id = input('id',0,'intval');
        $res = $this->obj->get($id);
        $categories = $this->obj->getCategoriesByParentID();
        return $this->fetch('',[
            'category' => $res,
            'categories' => $categories
        ]);
    }

    public function listorder(){
        if (request()->isPost()) {
            $id = input('id', 0, 'intval');
            $listorder = input('listorder', 0, 'intval');
            $res = $this->obj->save(['listorder' => $listorder], ['id' => $id]);

            if (!$res) {
                $this->result('', 0, '状态更新失败');
            } else {
                $this->result($_SERVER['HTTP_REFERER'], 1, '状态更新成功');
            }
        }
    }
}