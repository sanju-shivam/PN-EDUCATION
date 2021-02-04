<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\School\Teacher;
use App\SuperAdmin\ClassModel;
use App\SuperAdmin\Day;
use App\SuperAdmin\Time;
use App\SuperAdmin\Subject;
use App\School\TimeTable;
use Auth;
use Session;
use DB;

class TimeTableSchool extends Controller
{
    // public function art()
    // {
    //     Artisan::call("create:timetable");
    //     Artisan::call("migrate");
    // }

    public function create(Request $request)
    {
    	$days	 	= 	Day::all();
    	$classes 	= 	ClassModel::all();
        $times      =   Time::where('institute_id',Auth::user()->user_type_id)
                        ->get();

        $class_id = null;
        $Teachers = null;
        $subjects = null;

        if($request->has('class_id')){
            $Teachers   =   Teacher::where('institute_id',Auth::user()->user_type_id)
                        ->get();
            $subjects   =   Subject::all();
            $class_id = $request->class_id;
        }

    	return view('School.TimeTable.create',compact('days','classes','times','Teachers','subjects','class_id'));
    }


    public function store(Request $request)
    {
        if(TimeTable::where('institute_id', Auth::user()->user_type_id)->where('day_id',$request->day_id)->where('teacher_id',$request->teacher)->where('time_slot_id',$request->time_slot_id)->count() != 0){
            return back()->with('warning','Teacheer Has been already assigned in this time slot to another class on Same Day');
        }
        try{
            DB::transaction(function() use($request){
                DB::table('_time_table_school')->insert([
                    'class_id'  =>  $request->class_id,
                    'day_id'    =>  $request->day_id,
                    'teacher_id'=>  $request->teacher,
                    'subject_id'=>  $request->subject,
                    'institute_id' => Auth::user()->user_type_id,
                    'time_slot_id'  =>  $request->time_slot_id,
                    'row_id'        =>  $request->row_id,
                ]);
            });

            $time_table_data = TimeTable::select('class_id','day_id','teacher_id','subject_id','time_slot_id')->where('class_id',$request->class_id)->where('institute_id', Auth::user()->user_type_id)->get();
            return back()->with(['success','Class and Teacher assigned']);
        }
        catch(\Exception $e){
            dd($e);
        }
    }


    public function view(Request $request)
    {
        $days       =   Day::all();
        $classes    =   ClassModel::all();
        $times      =   Time::where('institute_id',Auth::user()->user_type_id)
                        ->get()->sortBy('start_time');
        $Teachers = null; $subjects = null; $time_tables = null; $class_id = null;
        if($request->has('class_id')){

            $Teachers   =   Teacher::where('institute_id',Auth::user()->user_type_id)
                            ->get();

            $subjects   =   Subject::all();

            $time_tables =  TimeTable::where('class_id',$request->class_id)
                            ->where('institute_id', Auth::user()->user_type_id)
                            ->get();
                            
            $class_id = $request->class_id;
        }

        return view('School.TimeTable.view_time_table',compact('days','classes','times','Teachers','subjects','time_tables','class_id'));


    }


}
