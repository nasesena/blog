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

/*Route::group(['middleware' => 'auth'], function () {
    Route::resource('/posts', 'PostsController', ['only' => ['store', 'create', 'update', 'destroy', 'delete', 'edit']]);
    Route::post('/create','PostsController@create');
    Route::post('/comment','PostsController@comment');
});*/


/*
// ログイン済みの状態。
Auth::routes();
// indexとhomeは誰でも使えるようにする。
Route::resource('/posts', 'PostsController', ['only' => ['index', 'show']]);
Route::get('/index','PostsController@index');*/
// ログイン済みの状態。
Auth::routes();
Route::resource('/posts', 'PostsController', ['only' => ['index', 'show','create']]);
Route::get('/index','PostsController@index');


// 全ユーザ
Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
    // ユーザ一覧
    Route::resource('/posts', 'PostsController', ['only' => ['index','show','create', 'update','comment','edit']]);
    Route::get('/index','PostsController@index');
    Route::post('/create','PostsController@create');
    
});

// 管理者
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {

    Route::resource('/posts', 'PostsController', ['only' => ['show','store', 'create', 'update', 'destroy', 'delete', 'edit','comment']]);
    Route::post('/comment','PostsController@comment');
    Route::post('/create','PostsController@create');
});

// システム管理者の設定
// システム管理者のみ
Route::group(['middleware' => ['auth', 'can:system-only']], function () {
    // ユーザ一覧
    Route::resource('/posts', 'PostsController', ['only' => ['show','store', 'create', 'update', 'destroy', 'delete', 'edit','comment']]);
    Route::post('/comment','PostsController@comment');
    Route::post('/create','PostsController@create');
    
});

Route::resource('/posts', 'PostsController', ['only' => ['index', 'show']]);




