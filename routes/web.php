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
    return redirect('index');
    //return view('welcome');
});

Route::get('test',"IndexController@test");

Route::any('login',"LoginController@login");

Route::group(['middleware'=>'check.login'],function(){

    Route::any('index',"IndexController@index");
    Route::any('index/welcome',"IndexController@welcome");
    Route::any('index/update_pass',"IndexController@update_pass");

    Route::any('system/index',"SystemController@index");

    Route::any('article/index',"ArticleController@index");
    Route::any('article/catgory',"ArticleController@catgory");
    Route::any('article/add_article',"ArticleController@add_article");
    Route::any('article/add_catgory',"ArticleController@add_catgory");

    Route::any('banner/index',"BannerController@index");
    Route::any('message/index',"MessageController@index");


    Route::post('login/out',"LoginController@out");

});



