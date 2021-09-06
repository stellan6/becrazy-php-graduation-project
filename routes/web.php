<?php

use Illuminate\Support\Facades\DB;

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

  //管理者ページ

Route::middleware(['auth'])->group(function(){

  Route::get('Alclist','PostController@Alclist');

  Route::get('Alcform','PostController@Alcform');

  Route::post('form','PostController@form');


  Route::get('Alcedit{id}','PostController@Alcedit');

  Route::post('edit','PostController@edit');

  Route::post('delete','PostController@delete');


  Route::get('Alcklist','TaxonomyController@Alcklist');

  Route::get('Alctlist','TaxonomyController@Alctlist');


  Route::get('Alcktform','TaxonomyController@Alcktform');

  Route::post('ktform','TaxonomyController@ktform');


  Route::get('Alcktedit{id}','TaxonomyController@Alcktedit');

  Route::post('ktedit','TaxonomyController@ktedit');

  Route::post('ktdelete','TaxonomyController@ktdelete');


  Route::get('Alcpform','PostController@Alcpform');

  Route::post('pform','PostController@pform');

  Route::get('Alcplist','PostController@Alcplist');

  Route::post('pdelete','PostController@pdelete');


  Route::get('Alcmlist','PostController@Alcmlist');

  Route::get('Alcmform','PostController@Alcmform');

  Route::post('mform','PostController@mform');

  //管理者ログインユーザーのパスワード変更
  Route::get('/password/change','Auth\ChangePasswordController@edit');

  Route::patch('/password/change','Auth\ChangePasswordController@update')->name('password.change');

  Route::get('/home', 'HomeController@index')->name('home');

});


  //閲覧用ページ

Route::get('/','PostController@top');
Route::get('top','PostController@top');

Route::get('/article/{slug}','PostController@kiji');

Route::get('list','PostController@list');

Route::get('kklist{slug}','PostController@kklist');

Route::get('tklist{slug}','PostController@tklist');


Auth::routes(['register' => DB::table('users')->count() == 0]);







