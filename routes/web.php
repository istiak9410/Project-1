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
//     return view('welcome');
// });
// Route::get('admin/contacts', 'ContactController@getIndex');
// Route::get('admin/contacts/data', 'ContactController@getData');
// Route::post('admin/contacts/store', 'ContactController@postStore');
// Route::post('admin/contacts/update', 'ContactController@postUpdate');
// Route::post('admin/contacts/delete', 'ContactController@postDelete');

Route::view('/', 'adminLayout');
Route::resource('blogs','BlogController');
Route::resource('contacts','ContactController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
