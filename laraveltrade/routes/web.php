<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/register", "RegisterController@index");

Route::post("/register", "RegisterController@register");

Route::get("/login", "LoginController@index");

Route::post("/login", "LoginController@login");

Route::get("/logout", "LoginController@logout");



Route::get("/posts", "PostController@index");

Route::get("/posts/create", "PostController@create");

Route::post("/posts", "PostController@store");

Route::get("/posts/{post}", "PostController@show");

Route::get("/posts/{post}/edit", "PostController@edit");

Route::put("/posts/{post}", "PostController@update");

Route::get("/posts/{post}/delete", "PostController@delete");

Route::post("/posts/image/upload", "PostController@imageUpload");

Route::post("/posts/{post}/comment", "PostController@comment");

Route::get("/posts/{post}/zan", "PostController@zan");

Route::get("/posts/{post}/unzan", "PostController@unzan");