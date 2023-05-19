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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// 商品一覧ページ表示 '/product'にアクセス時、ProductControllerのshowList()を呼び出す
Route::get('/product/list', 'ProductController@showList')->name('list');
// 新規投稿画面↓
Route::get('/product/register','ProductController@register')->name('postRegister');
// 新規登録処理↓
Route::post('/product/register', 'ProductController@entryProduct')->name('submit');
// 詳細画面表示↓
Route::get('detail/{id}', 'ProductController@detail')->name('detail');
// 更新処理
Route::post('update/{id}', 'ProductController@updateProduct')->name('update');
//削除処理↓
Route::post('/destroy/{id}', 'ProductController@destroy')->name('destroy');
