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


	// CLASS ROUTES
		Route::get('class/create','ClassController@create')->name('class.create');
		Route::post('class/store','ClassController@store')->name('class.store');
		Route::get('class/index', 'ClassController@index')->name('class.index');
		Route::get('class/edit/{id}', 'ClassController@edit')->name('class.edit');
		Route::post('class/update/{id}', 'ClassController@update')->name('class.update');
		Route::get('class/delete/{id}', 'ClassController@delete')->name('class.delete');

	
	// SECTION ROUTES
        Route::get('section/create', 'SectionController@create')->name('section.create');
        Route::post('section/store', 'SectionController@store')->name('section.store');
        Route::get('section/index', 'SectionController@index')->name('section.view');
        Route::get('section/edit/{id}', 'SectionController@edit')->name('section.edit');
        Route::post('section/update/{id}', 'SectionController@update')->name('section.update');
        Route::get('section/delete/{id}', 'SectionController@delete')->name('section.delete');
	


	// SCHOOL Softdeleted Routes in Class Controller beacuse 
	// It is no working in resource properly
		Route::get('deleted/school', 'ClassController@deleted_School')->name('school.deleted.view');
		Route::get('deleted/permanent/school/{id}', 'ClassController@permanent_delete')->name('school.deleted.permanent');
		Route::get('deleted/restore/school/{id}', 'ClassController@restore')->name('school.deleted.restore');



	//Subject Routes
		Route::get('subject/create','SubjectController@create')->name('subject.create');
		Route::post('subject/store','SubjectController@store')->name('subject.store');
		Route::get('subject/index', 'SubjectController@index')->name('subject.index');
		Route::get('subject/edit/{id}', 'SubjectController@edit')->name('subject.edit');
		Route::post('subject/update/{id}', 'SubjectController@update')->name('subject.update');
		Route::get('subject/delete/{id}', 'SubjectController@delete')->name('subject.delete');
		Route::get('subject/deleted', 'SubjectController@deleted_Subjects')->name('subject.deleted');
		Route::get('subject/deleted/permanent/{id}', 'SubjectController@permanent_delete')->name('subject.deleted.permanent');
		Route::get('subject/deleted/restore/{id}', 'SubjectController@restore')->name('subject.deleted.restore');


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
		Route::get('teacher/delete/{id}', 'TeacherController@delete')->name('teacher.delete');
		Route::post('/UpdateTeacherStatus','TeacherController@TeacherStatus');
		Route::get('deleted/teacher', 'TeacherController@deleted_Teacher')->name('teacher.deleted.view');
		Route::get('deleted/permanent/teacher/{id}', 'TeacherController@permanent_delete')->name('teacher.deleted.permanent');
		Route::get('deleted/restore/teacher/{id}', 'TeacherController@restore')->name('teacher.deleted.restore');



	//SCHOOL Routes
		Route::get('create/student','StudentController@create')->name('student.create');
		Route::post('student/store','StudentController@store')->name('student.store');
		Route::get('student/index', 'StudentController@index')->name('student.index');
		Route::get('student/show/{id}', 'StudentController@show')->name('student.show');
		Route::get('student/edit/{id}', 'StudentController@edit')->name('student.edit');
		Route::post('student/update/{id}','StudentController@update')->name('student.update');
		Route::get('student/delete/{id}', 'StudentController@delete')->name('student.delete');
		Route::post('/UpdateStudentStatus','StudentController@StudentStatus');
		Route::get('deleted/student', 'StudentController@deleted_students')->name('student.deleted.view');
		Route::get('student/deleted/restore/{id}', 'StudentController@restore_student')->name('student.deleted.restore');
		Route::get('student/deleted/permanent/{id}', 'StudentController@permanent_delete')->name('student.permanent.deleted');



	// Class Teacher Subject Relation
		Route::get('relation/class/subject/teacher','Class_Subject_Teacher_Realtion_Controller@create')->name('relation.class.subject.teacher');
		Route::post('class/teacher/subject/store','Class_Subject_Teacher_Realtion_Controller@store')->name('relation.class.subject.teacher.store');
		Route::get('relation/class/subject/teacher/edit/{id}','Class_Subject_Teacher_Realtion_Controller@edit')->name('relation.class.subject.teacher.edit');
		Route::post('class/teacher/subject/update/{id}','Class_Subject_Teacher_Realtion_Controller@update')->name('relation.class.subject.teacher.update');
		Route::get('relation/class/subject/teacher/delete/{id}','Class_Subject_Teacher_Realtion_Controller@delete')->name('relation.class.subject.teacher.delete');



	// IS Class Teacher Relation
		Route::get('relation/class/teacher','IS_Class_Teacher_Controller@create_and_index')->name('relation.class.teacher');
		Route::post('class/teacher/store','IS_Class_Teacher_Controller@store')->name('relation.class.teacher.store');
		Route::get('relation/class/teacher/edit/{id}','IS_Class_Teacher_Controller@edit')->name('relation.class.teacher.edit');
		Route::post('class/teacher/update/{id}','IS_Class_Teacher_Controller@update')->name('relation.class.teacher.update');
		Route::get('relation/class/teacher/delete/{id}','IS_Class_Teacher_Controller@delete')->name('relation.class.teacher.delete');
});







