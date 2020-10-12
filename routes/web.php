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

Route::get('login',"LoginController@login");

Route::group([],function(){

    Route::get('index',"IndexController@index");
    Route::get('index/welcome',"IndexController@welcome");

    Route::get('system/index',"SystemController@index");

    Route::get('article/index',"ArticleController@index");
    Route::get('article/catgory',"ArticleController@catgory");
    Route::get('article/add_article',"ArticleController@add_article");
    Route::get('article/add_catgory',"ArticleController@add_catgory");



});



