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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/Listcelebrity', 'Users\ListUsers@getusers');
});

Route::middleware('auth')->group(function () {
    Route::post('/DeleteUser', 'Users\ListUsers@DeleteUser')->middleware('role:admin');
});

Route::middleware('auth')->group(function () {
    Route::post('/AssignPermission', 'Users\ListUsers@AssignPermission')->middleware('role:admin');
});

Route::middleware('auth')->group(function () {
    Route::post('/Permission', 'Users\ListUsers@Permission')->middleware('role:admin');
});

Route::middleware('auth')->group(function () {
    Route::post('/assignrole', 'Users\ListUsers@assignrole')->middleware('role:admin');
});

Route::middleware('auth')->group(function () {
    Route::post('/Role', 'Users\ListUsers@Role')->middleware('role:admin');
});





Route::get('newpost', 'postcontroller@newpost')->middleware('role:writer|admin');
Route::post('create', 'postcontroller@createpost')->middleware('role:writer|admin');
Route::get('edit', 'postcontroller@edit')->middleware('permission:edit post');
Route::post('update', 'postcontroller@update')->middleware('role:editor');