<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/26
 * Time: 下午3:58
 */

namespace Common\Model;
use Think\Model;
class PositionModel extends Model{
    private $_db='';
    function __construct()
    {
        $this->_db = M('position');
    }

    public function getPositions(){
        $res = $this->_db->select();
        return $res;
    }
    public function insert($data){

        if (!$data || !is_array($data)){
            return 0;
        }

        return $this->_db->add($data);
    }
    public function updateStatusById($id,$status){
        if (!is_numeric($id) || !$id){
            throw_exception('ID不合法');
        }

        if (!is_numeric($status) || !$status){
            throw_exception('状态不合法');
        }
        $data['status'] = $status;

        return $this->_db->where('id='.$id)->save($data);

    }
    public function getMsgById($id){

        return $this->_db->where('id='.$id)->find();
    }

    public function updatePositionById($id, $data) {
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }

        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return $this->_db->where('id='.$id)->save($data);
    }
}
