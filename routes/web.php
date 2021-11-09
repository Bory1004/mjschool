<?php

use App\Http\Controllers\MainController;

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

//학생<->수업
Route::get('/user_class_join', 'MainController@user_class_join');
Route::get('/get_class/{user}', 'MainController@get_class');

Route::get('/get_user/{class}', 'MainController@get_user');

//학생->수업등록, 수업->수업삭제
Route::get('/insert_class_view/{user}', 'MainController@insert_class_view');
Route::post('/insert_class', 'MainController@insert_class');
Route::get('/delete_class/{class}/{user}', 'MainController@delete_class');