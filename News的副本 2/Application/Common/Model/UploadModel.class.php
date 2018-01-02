<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/30
 * Time: 下午2:13
 */
namespace Common\Model;
use Think\Model;
class UploadModel extends Model{

    private $_uploadObj = '';
    private $_uploadImageData = '';

    const UPLOAD = 'upload';

    public function __construct(){

        $this->_uploadObj = new \Think\Upload();

        $this->_uploadObj->rootPath = './' . self::UPLOAD . './';
        $this->_uploadObj->subName = date(Y) . '/' . date(m) . '/' . date(d);
    }

    public function upload(){
        $res = $this->_uploadObj->upload();
        if (!$res){
            return false;
        }
        else{
            return '/' . self::UPLOAD . '/' .$res['imgFile']['savepath'] . $res['imgFile']['savename'];
        }
    }
    public function upload_two(){
        $res = $this->_uploadObj->upload();
        if (!$res){
            return false;
        }
        else{
            return '/' . self::UPLOAD . '/' .$res['file']['savepath'] . $res['file']['savename'];
        }
    }
}
