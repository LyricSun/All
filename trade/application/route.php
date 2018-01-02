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
//
//Route::get('friends/:id','api/friends/read');
//
//Route::get('friends','api/friends/index');
//
//Route::post('friends','api/friends/save');
//
//Route::put('friends/:id','api/friends/update');
//
//Route::delete('friends/:id','api/friends/delete');

Route::resource('friends','api/friends');

Route::resource('time','api/time');

