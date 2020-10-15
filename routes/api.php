<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'check.api'],function(){

    Route::get('getBanner',"BannerController@getBanner");

    Route::get('getConfig',"IndexController@getConfig");

    Route::get('indexArticleList',"ArticleController@indexArticleList");

    Route::get('articleInfo',"ArticleController@articleInfo");

    Route::get('articleList',"ArticleController@articleList");



});



