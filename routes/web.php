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


// ログイン時に利用できる機能,作成系と削除系は権限を付与した
Route::group(['middleware' => 'auth'], function () {
    Route::resource('/posts', 'PostsController', ['only' => ['store', 'create', 'update', 'destroy', 'delete', 'edit']]);
    Route::post('/create','PostsController@create');
    Route::post('/comment','PostsController@comment');
    
    
    
   
});

// ログイン済みの状態。
Auth::routes();
// indexとhomeは誰でも使えるようにする。
Route::resource('/posts', 'PostsController', ['only' => ['index', 'show']]);
Route::get('/index','PostsController@index');


