<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/30
 * Time: 上午10:32
 */
namespace app\api\controller;

use app\common\lib\exception\ApiException;
use think\Validate;

class Home extends Common{
    public function index(){
        $arr = [];

        $limit = input('get.limit',3,'intval');
        $offset = input('get.offset',0,'intval');

        $header = $this->obj->getHeader($limit,$offset);
        if ($header){
            throw new ApiException('sfg',404);
        }
        $arr['header'] = $header;

        $position = $this->obj->getPositions($limit,$offset);
        if (!$position){
            throw new ApiException('sdds',404);
        }

    }
    public function init(){
        $data = input('param.');

        $validate = new Validate([
            'app_type' => ['require','regex'=>'/^(ios|android)$/i'],
            'version' => ['require','regex'=>'/^[0-9]\.[0-9]\.[0-9]$/']
        ]);
        if(!$validate->check($data)){
            throw new ApiException($validate->getError(),400,1001);
        }
        $appVersion = model('Version')->getLatestVersion($data['app_type']);

        return show(0,'OK',$appVersion);

    }
}