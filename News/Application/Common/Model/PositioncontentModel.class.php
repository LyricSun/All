<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/27
 * Time: 上午9:00
 */
namespace Common\Model;
use Think\Model;

class PositioncontentModel extends Model{
    private $_db = '';
    function __construct()
    {
        $this->_db = M('position_content');
    }

    public function getContents($page){

        $res = $this->_db->order('listorder DESC')->limit($page->firstRow.','.$page->listRows)->select();
        return $res;
    }
    //分页
    public function getCount()
    {
//        $data['status'] = array('neq', -1);
//        $data['type'] = $type;
        return $this->_db->count();
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
    public function  getAdMsg(){
        $data['position_id'] = 5;
        return $this->_db->where($data)->select();
    }

    public function  getListMsg(){
        $data['position_id'] = 3;
        return $this->_db->where($data)->select();
    }

}