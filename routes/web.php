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

Route::get('deleted',function(){
	// dd(Add_School::where('id',11)->restore());
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
Route::middleware(['auth','OnlySuperAdmin'])->group(function(){
	//  School Routes
		Route::resource('school','SuperAdmin\SchoolController');
		Route::get('school/delete/{id}','SuperAdmin\SchoolController@delete');
		Route::post('/SuperAdmin/UpdateSchoolStatus','SuperAdmin\SchoolController@SchoolStatus')->name('SuperAdmin.UpdateSchoolStatus');
});

//ONLY SCHOOL
Route::middleware('auth', 'OnlySchool')->group(function(){
	// Teacher Routes
		Route::get('teacher/create','School\TeacherController@create')->name('teacher.create');
		Route::post('teacher/store','School\TeacherController@store')->name('teacher.store');
		Route::get('teacher/index', 'School\TeacherController@index')->name('teacher.index');
		Route::get('teacher/show/{id}', 'School\TeacherController@show')->name('teacher.show');
		Route::get('teacher/edit/{id}', 'School\TeacherController@edit')->name('teacher.edit');
		Route::post('teacher/update/{id}', 'School\TeacherController@update')->name('teacher.update');
		Route::get('teacher/delete/{id}', 'School\TeacherController@edit')->name('teacher.delete');

	// Class Routes
		Route::get('class/create','School\ClassController@create')->name('class.create');
		Route::post('class/store','School\ClassController@store')->name('class.store');
		Route::get('class/index', 'School\ClassController@index')->name('class.index');
		Route::get('class/edit/{id}', 'School\ClassController@edit')->name('class.edit');
		Route::post('class/update/{id}', 'School\ClassController@update')->name('class.update');
		Route::get('class/delete/{id}', 'School\ClassController@delete')->name('class.delete');

	//Subject Routes
		Route::get('subject/create','School\SubjectController@create')->name('subject.create');
		Route::get('subject/store','School\SubjectController@store')->name('subject.store');
});







