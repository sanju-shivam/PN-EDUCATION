<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\ClassModel;
use App\School\Teacher;
use Auth;
use DB;
use Carbon\Carbon;
use App\School\Is_Class_teacher;

class IS_Class_Teacher_Controller extends Controller
{
    public function create_and_index()
    {
    	$classes 	= 	ClassModel::all();
    	$teachers	=	Teacher::where('institute_id', '=', Auth::user()							->user_type_id)->get();
    	$relations = Is_Class_teacher::where('institute_id',Auth::user()->user_type_id)->get();

    	return view('School.Relation.Class_Teacher.Create',compact('classes','teachers','relations'));
    }

    public function store(Request $request)
    {
    	$relationAlreadyPresent = Is_Class_teacher::where('class_id',$request->class_id)->where('teacher_id',$request->teacher_id)->where('institute_id',Auth::user()->user_type_id)->count();

         if($relationAlreadyPresent != 0){
            return back()->with('warning','Relation Is Already Present Pleaase Check Again');
         }

    	try{
    		DB::transaction(function() use($request){
    			$class_teacher = DB::table('is_class_teacher')->insert([
    				'class_id'		=>	$request->class_id,
    				'teacher_id'	=>	$request->teacher_id,
    				'institute_id'	=>	Auth::user()->user_type_id,
   					'created_at'   	=>	Carbon::now(),
                    'updated_at'   	=>	Carbon::now(),
    			]);
    		});

    		return redirect('relation/class/teacher')->with('success','Class Teaher assigned to Classes');
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
    	$teachers	=	Teacher::where('institute_id',Auth::user()->user_type_id)->get();
    	$relation 	=	Is_Class_teacher::where('institute_id',Auth::user()->user_type_id)->find($id);

    	return view('School.Relation.Class_Teacher.Edit',compact('relation','teachers','classes'));
    }


    public function update(Request $request, $id)
    {
    	try{
   			Is_Class_teacher::find($id)->update([
   				'class_id'		=>	$request->class_id,
                'updated_at'   	=>	Carbon::now(),
   			]);
   			
   			return redirect('relation/class/teacher')->with('success','Relation Updated SuccessFully');
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
    	$relation = Is_Class_teacher::find($id)->delete();
   		if($relation){
   			return back()->with('success','Relation Deleted SuccessFully');
   		}
   		else{
   			return back()->with('warning','Error Occour Please try Again After Reloading Page');
   		}
    }
}
