<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\SuperAdmin\Add_School;
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

Route::get('deleted',function(){
	dd(Add_School::where('id',11)->restore());
});

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('has',function(){
	dd(Hash::make('12345678'));
});

Auth::routes();

Route::middleware('auth')->group(function(){
	//Common Routes To all
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout','HomeController@logout')->name('logout');
});

//ONLY SUPER ADMIN
Route::middleware('auth')->group(function(){
	//  School Routes
		Route::resource('school','SuperAdmin\SchoolController');
		Route::get('school/delete/{id}','SuperAdmin\SchoolController@delete');
		Route::post('/SuperAdmin/UpdateSchoolStatus','SuperAdmin\SchoolController@SchoolStatus')->name('SuperAdmin.UpdateSchoolStatus');

	// Admin Routes
		// Route::get('admin/create','SuperAdmin\AdminController@create')->name('admin.create');
		// Route::post('admin/store','SuperAdmin\AdminController@store')->name('admin.store');
});







