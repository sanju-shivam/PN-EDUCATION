<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\ClassModel;
use App\SuperAdmin\Day;
use App\SuperAdmin\Section;
use App\SuperAdmin\Subject;
use App\SuperAdmin\Time;
use App\School\Teacher;
use App\School\ClassSchedule;
use Auth;
use Carbon\Carbon;
use DB;

class ClassScheduleController extends Controller
{
   
   public function fields(){
      $classes   = ClassModel::all();
      $days      = Day::all();
      $sections  = Section::all();
      $subjects  = Subject::all();
      $times     = Time::all();
      $teachers  = Teacher::where('institute_id', '=', Auth::user()->user_type_id)->get();
      
     return view('School.class_schedules.fields', compact( 'classes', 'days', 'sections', 'subjects', 'times', 'teachers'));
    }
    
    public function store(Request $request){
       try{
          DB::transaction(function() use($request){
            DB::table('class_schedule')->insert([
              'class_id'     =>$request->class_id,
              'institute_id' =>$request->institute_id,
              'section_id'   =>$request->section_id,
              'subject_id'   =>$request->subject_id,
              'teacher_id'   =>$request->teacher_id,
              'day_id'       =>$request->day_id,
              'time_id'      =>$request->time_id,            
              'created_at'   =>   Carbon::now(),
              'updated_at'   =>   Carbon::now(),
            ]);  
          });
          return redirect('class_schedule/view')->with('success', 'Schedule Created Sccessfully');
       }
       catch(\Exception $e){
           if(!empty($e->errorInfo[2])){
             return back()->with('warning',$e->errorInfo[2]);
            }
            else if(!empty($e->getMessage())){
              return back()->with('warning',$e->getMessage().'   at   '.$e->getline());
            }else{
             return back()->with('warning','Error Occour Please try Again After Reloading Page');
            }
        }
    }

    public function index(){
    
      $class_schedules = ClassSchedule::where('institute_id', Auth::user()->user_type_id)->get();
      return view('School.class_schedules.index',compact('class_schedules'));
    }

  }
