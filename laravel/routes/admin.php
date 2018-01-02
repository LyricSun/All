<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/14
 * Time: 上午10:30
 */


Route::group(['prefix' => 'admin'],function (){

    Route::get("/login", "\App\Admin\Controllers\LoginController@index");

    Route::post("/login", "\App\Admin\Controllers\LoginController@login");

    Route::get("/logout", "\App\Admin\Controllers\LoginController@logout");


    Route::group(['middleware' => 'auth:admin'],function (){

        Route::get("/home", "\App\Admin\Controllers\HomeController@index");

        Route::group(['middleware' => 'can:post'],function (){

            Route::get("/posts", "\App\Admin\Controllers\PostController@index");
            Route::post("/posts/{post}/status", "\App\Admin\Controllers\PostController@status");

        });

        Route::group(['middleware' => 'can:topic'],function (){

//            Route::get("/topics", "\App\Admin\Controllers\TopicController@index");
//            Route::get("/topics/create", "\App\Admin\Controllers\TopicController@create");
//            Route::post("/topics", "\App\Admin\Controllers\TopicController@add");
//            Route::get("/topics/{topic}/delete", "\App\Admin\Controllers\TopicController@delete");

            Route::resource('topics','\App\Admin\Controllers\TopicController',['only' => ['index','create','store','destroy']]);
        });


        Route::group(['middleware' => 'can:system'],function (){


            Route::get("/users", "\App\Admin\Controllers\UserController@index");
            Route::get("/users/create", "\App\Admin\Controllers\UserController@create");
            Route::post("/users/store", "\App\Admin\Controllers\UserController@store");
            Route::get("/users/{user}/role", "\App\Admin\Controllers\UserController@role");
            Route::post("/users/{user}/role", "\App\Admin\Controllers\UserController@storeRole");

            Route::get("/roles", "\App\Admin\Controllers\RoleController@index");
            Route::get("/roles/create", "\App\Admin\Controllers\RoleController@create");
            Route::post("/roles/store", "\App\Admin\Controllers\RoleController@store");
            Route::get("/roles/{role}/permission", "\App\Admin\Controllers\RoleController@permission");
            Route::post("/roles/{role}/permission", "\App\Admin\Controllers\RoleController@storePermission");

            Route::get("/permissions", "\App\Admin\Controllers\PermissionController@index");
            Route::get("/permissions/create", "\App\Admin\Controllers\PermissionController@create");
            Route::post("/permissions/store", "\App\Admin\Controllers\PermissionController@store");

        });


        Route::group(['middleware' => 'can:notice'],function (){

                Route::resource('notices','\App\Admin\Controllers\NoticeController',['only' => 'index','create','store']);

        });

    });

});
