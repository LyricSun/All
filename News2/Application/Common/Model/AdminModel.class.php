<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/20
 * Time: 下午3:28
 */

namespace Common\Model;

use Think\Model;

class AdminModel extends Model{

    private $_db ='';

    function __construct(){

        $this->_db = M('admin');

    }

    public function getUserByUsername($username){

        $res = $this->_db->where("username='".$username."'")->find();

        return $res;

    }

}
