<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/1
 * Time: 下午4:33
 */
namespace Common\Model;
use Think\Model;
class HomeModel extends Model{

    private $_db = '';

    function __construct()
    {
        $this->_db = M('position_content');
    }

    public function getImageUrl(){
        $data['status'] = 1;
        $data['position_id'] = 2;
        return $this->_db->where($data)->select();
    }

}