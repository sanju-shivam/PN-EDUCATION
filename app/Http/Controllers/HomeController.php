<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\SuperAdmin\Add_School;
use App\School\Teacher;
use App\School\Student;
use Auth;
use App\CommonModels\Role;
use Cache;
use Str;
use Artisan;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $schools = null;
        $teacher = null;
        $students = null;
        $user_role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;
        // IF USER IS SuperAdmin USER GET 
                //  1 : TEACHER COUNT AND SCHOOL COUNT
        if($user_role_id == Role::where('name','SuperAdmin')->first()->id ){
                $schools = Cache::remember('school-count-superadmin',60*60,function(){
                    return Add_School::count();
                }); 
                $teacher = Cache::remember('school-count-superadmin',60*60,function(){
                    return Teacher::count();
                });
                $students =  Cache::remember('school-count-superadmin',60*60,function(){
                    return Student::count();
                });
        }   
        // IF USER IS SCHOOL USER GET   ===>>>> 1 : TEACHER COUNT
        else if($user_role_id == Role::where('name','School')->first()->id){
            Cache::remember('school-'.$user_id, 60*60, function () {
                return Add_School::select('id','name','email')->where('id',Auth::user()->user_type_id)->first();
            });

            Cache::forever('school_name_slug',Str::slug(Cache::get('school-'.$user_id)->name));
            $teacher = Cache::remember('teachers-institute-wise-count-'.$user_id, 60*60, function () use($user_id) {
                return Teacher::where('institute_id',Cache::get('school-'.$user_id)->id)->where('deleted_at','=',null)->count(); 
            });
            $students = Cache::remember('students-institute-wise-count'.$user_id,60*60,function() use($user_id){
                return Student::where('institute_id',Cache::get('school-'.$user_id)->id)->where('deleted_at','=',null)->count();
            });
        }
        else if(
            $user_role_id == Role::where('name','Teacher')->first()->id
        ){
            Cache::forever('school',function(){
                
                return Add_School::select('id','name')->where('id',Auth::user()->user_type_id)->first();
            });
            Cache::forever('school_name_slug', function(){
                return Str::slug(Cache::get('school')->name);
            });
        }
        else if($user_role_id == Role::where('name','Student')->first()->id){

        }
        
        return view('home',compact('schools','teacher','students'));
    }

    public function logout()
    {

        Session::flush();
        return redirect('/');
    }
}
