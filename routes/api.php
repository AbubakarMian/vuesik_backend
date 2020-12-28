<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware'=>'auth.client'],function(){

    Route::post('signup', 'Services\UserController@signUp');
    Route::post('login', 'Services\UserController@login');
});

Route::group(['middleware'=>'auth.token'],function(){
    Route::post('video', 'Services\UserController@video');
   
});


Route::post('logout', 'Services\UserController@logout');

Route::get('home', 'Services\UserController@home');
Route::post('videocomments', 'Services\UserController@videocomments');
Route::post('videomention', 'Services\UserController@videomention');
Route::post('tag', 'Services\UserController@tag');
Route::post('userprofile', 'Services\UserController@userprofile');
Route::post('user_update', 'Services\UserController@user_update');
Route::post('mannage_account', 'Services\UserController@mannage_account');
Route::post('payout', 'Services\UserController@payout');
Route::post('send_message', 'Services\UserController@send_message');
Route::post('topusers', 'Services\UserController@topusers');
Route::post('videotag', 'Services\UserController@videotag');
Route::post('hashtag', 'Services\UserController@hashtag');
Route::post('userslist', 'Services\UserController@userslist');
Route::post('videoslist', 'Services\UserController@videoslist');
Route::post('audiolist', 'Services\UserController@a b udiolist');
Route::post('likelist', 'Services\UserController@likelist');



Route::post('likes','Services\UserController@likes');
Route::post('comments','Services\UserController@comment_list');
Route::post('mentions','Services\UserController@mentions_list');
Route::post('followers','Services\UserController@followers');
Route::post('myfollowers','Services\UserController@myfollowers');
Route::post('recommended_users','Services\UserController@recommended_users');

