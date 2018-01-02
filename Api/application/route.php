<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::resource('friends','api/friends');

Route::resource('time','api/time');

Route::resource('cat','api/cat');

Route::resource('home','api/home');

Route::resource('newslist','api/newslist');

Route::get('init','api/home/init');

Route::resource('ver','api/verification');
