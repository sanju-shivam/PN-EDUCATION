<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
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
})->name('/');

Route::get('has',function(){
	dd(Hash::make('123456789'));
});

Auth::routes();

Route::middleware('auth')->group(function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout','HomeController@logout')->name('logout');


	//  School Routes
	Route::get('school_details','SuperAdmin\SuperAdminController@index')->name('view/school');
	Route::get('add_school', 'SuperAdmin\SuperAdminController@create');
	Route::post('add_school', 'SuperAdmin\SuperAdminController@store');
	Route::get('school_details/{id}', 'SuperAdmin\SuperAdminController@show');
	Route::get('edit_school/{id}', 'SuperAdmin\SuperAdminController@edit' );
	Route::post('update_school', 'SuperAdmin\SuperAdminController@update' );
	Route::get('delete/{id}', 'SuperAdmin\SuperAdminController@delete' );


});
