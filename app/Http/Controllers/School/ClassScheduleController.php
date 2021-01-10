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
use DB;

class ClassScheduleController extends Controller
{
   // public function fields(){
   	
   // 	// dd($classes);
   // 	return view('School.class_schedules.fields');
   // }

   public function fields(){
    $classes   = ClassModel::all();
    $days      = Day::all();
    $sections  = Section::all();
    $subjects  = Subject::all();
    $times     = Time::all();
    $teachers  = Teacher::all();
    $schedules = ClassSchedule::all();
    return view('School.class_schedules.fields', compact('schedules', 'classes', 'days', 'sections', 'subjects', 'times', 'teachers'));

    // if($request->isMethod('post')){
    //   $data = $request->all();
    
      //  try{
      //    DB::transaction(function() use($request){
      //     $schedule = DB::table('class_schedule')->insertGetId([
      //       'subject_id'  =>$request->subject,
      //       'class_id' =>$request->class,
      //      ]);
      //     dd($schedule);
      //    });
      // }
      // catch(\Exception $e){}
      // return view('School.class_schedules.fields');
    // }
    }
   }
