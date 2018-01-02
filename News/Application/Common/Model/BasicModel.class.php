<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/2
 * Time: 上午9:27
 */
namespace Common\Model;
use Think\Model;
class BasicModel extends Model{
    public function __construct(){

    }

    public function save($data){
        if(!$data){
            throw_exception('错误');
        }
        return F('temp',$data);

    }
    public function select(){
        $res =F('temp');
        return $res;
    }

}