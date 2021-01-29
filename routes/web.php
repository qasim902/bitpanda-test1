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


Route::get('/users','mainController@users')->name('users');

Route::get('/user-edit','mainController@getUser')->name('user-edit');
Route::get('/user-edit-add/{id?}','mainController@getUserAdd')->name('user-edit-add');
Route::get('/user-edit-add-post/{id?}','mainController@getUserAddPost')->name('user-edit-add-post');
Route::get('/user-delete','mainController@getDeleteUser')->name('user-delete');
Route::get('/user-delete-post/{id?}','mainController@getDeleteUserPost')->name('user-delete-post');
