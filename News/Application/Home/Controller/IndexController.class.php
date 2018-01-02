<?php
namespace Home\Controller;
use Think\Controller;
use Think\Storage;
class IndexController extends Controller {
    public function index($type = ''){

        $res1 = D('Home')->getImageUrl();

        $res2 = D('Menu')->getMenuName();

        $res3 = D('Content')->getSmallTitle();

        $res4 = D('Positioncontent')->getAdMsg();

        $res5 = D('Positioncontent')->getListMsg();
//        dump($res2);exit();

        $this->assign('result',$res1);

        $this->assign('navs',$res2);

        $this->assign('sm_title',$res3);

        $this->assign('adv',$res4);

        $this->assign('list',$res5);

        if ($type == 'buildhtml'){
            $this->buildHtml('index',HTML_PATH,'Index/index');
        }
        else{
            $this->display();
        }

    }

    protected function buildHtml($htmlfile='',$htmlpath='',$templateFile='') {
        $content    =   $this->fetch($templateFile);
        $htmlpath   =   !empty($htmlpath)?$htmlpath:HTML_PATH;
        $htmlfile   =   $htmlpath.$htmlfile.C('HTML_FILE_SUFFIX');
        Storage::put($htmlfile,$content,'html');
        return $content;
    }

    public function build_html(){

        $this->index('buildhtml');
        return show(1,'首页缓存成功');

    }
    public function set_build_html(){

        $this->index('buildhtml');

    }
}