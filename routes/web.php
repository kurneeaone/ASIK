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

Route::get('/','Controller@index');
Route::get('/search/{no}','Controller@search')->name('search');
Route::get('/panduan','Controller@panduan');
Route::get('/print/{no}','Controller@print');
Route::post('/login','Controller@login')->name('login');
Route::get('/logout','Controller@logout')->name('logout');
Route::middleware(['auth'])->group(function(){
    Route::get('/admin','Controller@admin');
    Route::get('/setting','Controller@setting');
    Route::post('/setting/update','Controller@setting_update');
    Route::get('/setting/delete','Controller@setting_delete');

    Route::get('/siswa','Controller@siswa');
    Route::post('/siswa/import','Controller@siswa_import');
    Route::post('/siswa/add','Controller@siswa_add');
    Route::post('/siswa/edit','Controller@siswa_edit');
    Route::get('/siswa/delete/{id}','Controller@siswa_delete');
    Route::get('/siswa/delete-all','Controller@siswa_delete_all');

    Route::get('/nilai','Controller@nilai');
    Route::post('/nilai/add','Controller@nilai_add');
    Route::get('/nilai/delete-all','Controller@nilai_delete_all');
    Route::get('/nilai/delete/{id}','Controller@nilai_delete');
    Route::post('/nilai/edit/','Controller@nilai_edit');
    Route::post('/nilai/import/','Controller@nilai_import');
    
    Route::get('/user','Controller@user');
    Route::post('/user/add','Controller@user_add');
    Route::post('/user/edit','Controller@user_edit');
    Route::get('/user/delete/{id}','Controller@user_delete');

    Route::get('/cek','Controller@cek');
});
