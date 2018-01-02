<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/20
 * Time: 下午3:27
 */
//命名空间
namespace Common\Model;
use Think\Model;
//让AdminModel继承Model的性质
class AdminModel extends Model{
    //private 修饰符是私有的,$_db在类里可用,类外不可.意在声明$_db初始值为空
    private $_db = '';
    //特殊的构造函数,只要类进行了,此函数自动执行,不用调用
    function __construct()
    {
        //要建立与数据库的联系要在Model中实现,之所以不在Admin中的Model内写是因为common内是公共资源,其他模块也可能存在需求,这样,别的模块也可以访问
        //相当于把数据库里admin的表赋给前面的,相当于实例化名为admin的数据表,之所以没有cms.是因为在刚开始配置时,数据库表前缀已经设置了cms_
        $this->_db = M('admin');
    }
//声明一个公用的函数,意思就是当调用时在Admin数据库表中找到用户名为$username的数据,将此结果赋给$res,并返回其值
    public function getUserByUsername($username) {
        $res = $this->_db->where("username='".$username."'")->find();
        return $res;

    }
    public function getAdmin($page){
        $res = $this->_db->limit($page->firstRow.','.$page->listRows)->select();
        return $res;

    }
//分页
    public function getCount()
    {
//        $data['status'] = array('neq', -1);
//        $data['type'] = $type;
        return $this->_db->count();
    }
    public function insert($data)
    {
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
        return $this->_db->where('admin_id='.$id)->save($data);
    }
}