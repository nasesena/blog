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

// CRUDのルーティングをここで行う
//Route::resource('posts', 'Controller');

//アクションの実装を書くならここ！「アドレスにアクセスしたら、この処理を実行する」
// 使えるやつを確認しよう！
//Route::resource('posts','PostsController');


/*
Route::get('/', function() {
    return view('index');
});*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/


// ログイン時に利用できる機能,一旦はログインユーザのみ全ての権限を付与
Route::group(['middleware' => 'auth'], function () {
    Route::resource('posts','PostsController', ['only' => ['index','show','store', 'create', 'update', 'destroy', 'delete', 'edit','comment']]);
    Route::post('/comment','PostsController@comment');
    Route::post('/index', 'PostController@index');
    
   
});

// ログイン済みの状態。
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


