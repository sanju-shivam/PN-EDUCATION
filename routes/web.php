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
	dd(Cache::get('school'));
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
	//Common Routes To all after Login
	Route::get('/home', 'HomeController@index')->name('home');
	Route::post('/logouts','HomeController@logout')->name('logouts');
});

//ONLY SUPER ADMIN
Route::namespace('SuperAdmin')->middleware(['auth','OnlySuperAdmin'])->group(function(){
	//  School Routes
		Route::resource('school','SchoolController');
		Route::get('school/delete/{id}','SchoolController@delete');
		Route::post('/SuperAdmin/UpdateSchoolStatus','SchoolController@SchoolStatus')->name('SuperAdmin.UpdateSchoolStatus');

	// Class Routes
		Route::get('class/create','ClassController@create')->name('class.create');
		Route::post('class/store','ClassController@store')->name('class.store');
		Route::get('class/index', 'ClassController@index')->name('class.index');
		Route::get('class/edit/{id}', 'ClassController@edit')->name('class.edit');
		Route::post('class/update/{id}', 'ClassController@update')->name('class.update');
		Route::get('class/delete/{id}', 'ClassController@delete')->name('class.delete');


		//Subject Routes
		Route::get('subject/create','SubjectController@create')->name('subject.create');
		Route::post('subject/store','SubjectController@store')->name('subject.store');
		Route::get('subject/index', 'SubjectController@index')->name('subject.index');
		Route::get('subject/edit/{id}', 'SubjectController@edit')->name('subject.edit');
		Route::post('subject/update/{id}', 'SubjectController@update')->name('subject.update');
		Route::get('subject/delete/{id}', 'SubjectController@delete')->name('subject.delete');
		Route::get('subject/deleted', 'SubjectController@deleted_Subjects')->name('subject.deleted');
});

//ONLY SCHOOL
Route::namespace('School')->middleware(['auth','OnlySchool'])->group(function(){
	// Teacher Routes
		Route::get('teacher/create','TeacherController@create')->name('teacher.create');
		Route::post('teacher/store','TeacherController@store')->name('teacher.store');
		Route::get('teacher/index', 'TeacherController@index')->name('teacher.index');
		Route::get('teacher/show/{id}', 'TeacherController@show')->name('teacher.show');
		Route::get('teacher/edit/{id}', 'TeacherController@edit')->name('teacher.edit');
		Route::post('teacher/update/{id}', 'TeacherController@update')->name('teacher.update');
		Route::get('teacher/delete/{id}', 'TeacherController@edit')->name('teacher.delete');
});







