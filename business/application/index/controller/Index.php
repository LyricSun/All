<?php
namespace app\index\controller;

use think\Controller;

class Index extends Base {
    public function index(){
        $midImages = model('Featured')->getAllFeaturedByCondition(['status'=>1,'type'=>0]);
        $rightImages = model('Featured')->getAllFeaturedByCondition(['status'=>1, 'type'=>1]);
        $deals = model('Deal')->getDealsByIdLimitCity(1,10,$this->city->id);
        $se_cats = model('Category')->getCategoriesByParentIDWithLimit(1,4);
//        print_r($deals);
//        print_r($this->city->name);
        return $this->fetch('',[
            'midImages' => $midImages,
            'rightImages' => $rightImages,
            'deals' => $deals,
            'se_cats' => $se_cats
        ]);
    }
}
