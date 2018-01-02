<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/27
 * Time: 上午9:52
 */
namespace Common\Model;
use Think\Model;
class PositioncontentModel extends Model
{
    private $_db = '';

    function __construct()
    {
        $this->_db = M('position_content');
    }
    public function getPositioncontent(){
        $res = $this->_db->select();
        return $res;
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
}