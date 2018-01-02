<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/2
 * Time: 下午4:01
 */
namespace Home\Controller;
use Think\Controller;
class CronController extends Controller {
    public function dumpmysql(){

        $shell = '/usr/local/mysql/bin/mysqldump -uroot -p news_cms > /Library/WebServer/news.sql';
        exec($shell);
    }

}