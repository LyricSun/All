<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/15
 * Time: 上午9:54
 */
namespace app\admin\controller;

class Featured extends Base{
    private $obj;
    protected function _initialize()
    {
        parent::_initialize();
        $this->obj = model('Featured');
    }
    public function index(){
        $featured = $this->obj->getAllFeatured();
        $types = config('type');
        return $this->fetch('',[
            'featured' => $featured,
            'types' => $types
        ]);
    }
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            $this->checkData('Featured','add',$data);
            $res = $this->obj->save($data);
            if (!$res){
                $this->error('添加推荐为失败');
            }
            else{
                $this->success('添加推荐位成功');
            }
        }
        $types = config('type');
        return $this->fetch('',[
            'types' => $types
        ]);
    }
}