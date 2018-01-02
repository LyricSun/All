<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/27
 * Time: 上午9:36
 */
namespace Common\Model;
use Think\Model;

class ContentModel extends Model{
    private $_db = '';
    function __construct()
    {
        $this->_db = M('news');
    }
    public function getContent($Page){
        $res = $this->_db->order('listorder DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
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
        return $this->_db->where('news_id='.$id)->save($data);
    }
    public function contentAdd($data){
        $data['username'] = 'admin';
        $data['content_time'] = time();
        $res = $this->_db->add($data);
        return $res;

    }
    public function getSmallTitle(){
        $data['status'] = 1;
        return $this->_db->where($data)->select();
    }
    public function getNews($id){
        $data['status'] = 1;
        $data['catid'] =$id;
        return $this->_db->where($data)->select();

    }
}
