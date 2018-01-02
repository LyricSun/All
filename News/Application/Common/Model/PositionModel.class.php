<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/26
 * Time: 下午3:59
 */
namespace Common\Model;
use Think\Model;
class PositionModel extends Model
{
    //操作数据库固定写法
    private $_db = '';

    function __construct()
    {
        $this->_db = M('position');
    }

    function getPosition($Page){
        $res = $this->_db->limit($Page->firstRow.','.$Page->listRows)->select();
        return $res;
    }

    public function getCount()
    {
//        $data['status'] = array('neq', -1);
//        $data['type'] = $type;
        return $this->_db->count();
    }

    function insert($data){
        if (!$data || !is_array($data)) {
            return 0;
        }

        return $this->_db->add($data);
    }
    public function updateStatusById($id,$status){
        if (!is_numeric($id) || !$id) {
            //异常机制跟try....catch配合使用,人为制造一个警报
            throw_exception('ID不合法');

        }
        if (!is_numeric($status) || !$status) {
            throw_exception('状态不合法');

        }
        $data['status'] = $status;
        return $this->_db->where('id='.$id)->save($data);
    }
    public function update($id){
        return  $this->_db->where('id='.$id)->find();

    }

    public function change($id,$data) {
        return $this->_db->where('id='.$id)->save($data);
    }

    public function getPositionName(){
        $data['status'] = 1;
        return $this->_db->where($data)->select();
    }

//    public function getPositionName(){
//        $res = $this->_db->select();
//        return $res;
//    }





}