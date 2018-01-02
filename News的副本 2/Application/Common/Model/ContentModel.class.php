<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/27
 * Time: 上午9:38
 */

namespace Common\Model;
use Think\Model;
class ContentModel extends Model
{
    private $_db = '';

    function __construct()
    {
        $this->_db = M('news');
    }
    public function getNews(){
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

        return $this->_db->where('news_id='.$id)->save($data);

    }
}