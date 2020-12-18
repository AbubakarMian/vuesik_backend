<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/admin'], function(){
       Route::get('/login','Admin\AdminController@login');
       Route::post('/checklogin','Admin\AdminController@checklogin'); 
       Route::get('/logout', 'Admin\AdminController@logout')->name('logout');
       Route::get('dashboard', 'Admin\AdminController@dashboard')->name('dashboard');
});