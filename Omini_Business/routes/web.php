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

// Route::get('/', function () {
//     $contacts = DB::table('contact')->get();
//     dd($contacts);
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('Admin-Home');
    Route::get('/home','AdminController@index')->name('Admin_Dashboard');
    Route::get('/edit/profile','AdminController@editprofile');
    Route::post('/update/profile','AdminController@updateprofile');
    Route::get('/request_list/{type}','AdminController@requests');
    Route::post('/ckediter/upload','AdminController@upload_images')->name('ckeditor.image-upload');
    Route::get('/news','AdminController@NewsList');
    Route::post('/add/news','AdminController@addnews');
    Route::post('/edit/news/{id}','AdminController@editnews');
    Route::get('/career','AdminController@CareerList');
    Route::post('/add/career','AdminController@addcareer');
    Route::post('/edit/career/{id}','AdminController@editcareer');
    Route::get('/logout', 'AdminController@logout')->name('Admin-Logout');

});