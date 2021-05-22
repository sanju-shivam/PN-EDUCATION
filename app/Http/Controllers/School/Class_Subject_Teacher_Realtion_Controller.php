<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\ClassModel;
use App\SuperAdmin\Subject;
use App\School\Teacher;
use Auth;
use App\School\Class_Subject_Teacher;
use DB;
use Illuminate\Support\Facades\validate;
use Carbon\Carbon;

class Class_Subject_Teacher_Realtion_Controller extends Controller
{
   	public function create()
   	{
   		$classes 	= 	ClassModel::all();
   		$subjects 	= 	Subject::all();
   		$teachers	=	Teacher::where('institute_id', '=', Auth::user()							->user_type_id)->get();
   		$relations = Class_Subject_teacher::where('institute_id',Auth::user()->user_type_id)->get();

   		return view('School.Relation.Class_Subject_teacher.Create',compact('classes','subjects','teachers','relations'));
   	}

   	public function store(Request $request)
   	{

    	$relationAlreadyPresent = Class_Subject_Teacher::where('class_id',$request->class_id)->where('subject_id',$request->subject_id)->where('teacher_id',$request->teacher_id)->where('institute_id',Auth::user()->user_type_id)->count();
    	if($relationAlreadyPresent){
    		return back()->with('warning','Relation Is Already Present Please Check Again');
    	}
   		try{
   			DB::transaction(function() use ($request){
   				DB::table('class_with_subject_with_teacher')->insert([
   					'class_id'		=>	$request->class_id,
   					'subject_id'	=>	$request->subject_id,
   					'teacher_id'	=>	$request->teacher_id,
   					'institute_id'	=>	Auth::user()->user_type_id,
   					'created_at'   =>		Carbon::now(),
                    'updated_at'   =>		Carbon::now(),
   				]);
   			});

   			return redirect('relation/class/subject/teacher')->with('success','Relation Is Created');
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


   	public function edit($id)
   	{
   		$classes 	= 	ClassModel::all();
   		$subjects 	= 	Subject::all();
   		$teachers	=	Teacher::where('institute_id', '=', Auth::user()							->user_type_id)->get();
   		$relation = Class_Subject_Teacher::where('institute_id',Auth::user()->user_type_id)->find($id)->first();
   		return view('School.Relation.Class_Subject_teacher.edit',compact('relation','classes','subjects','teachers'));
   	}


   	public function update(Request $request, $id)
   	{
   		try{
   			Class_Subject_Teacher::find($id)->update([
   				'class_id'		=>	$request->class_id,
				'subject_id'	=>	$request->subject_id,
                'updated_at'   	=>	Carbon::now(),
   			]);
   			return redirect('relation/class/subject/teacher')->with('success','Relation Updated SuccessFully');
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



   	public function delete($id)
   	{
   		$class = Class_Subject_Teacher::find($id)->delete();
   		if($class){
   			return back()->with('success','Relation Deleted SuccessFully');
   		}
   		else{
   			return back()->with('warning','Error Occour Please try Again After Reloading Page');
   		}
   	}
}
