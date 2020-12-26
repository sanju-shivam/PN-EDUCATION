<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\School\ClassModel;
use DB;

use Session;

class ClassController extends Controller
{
    public function create()
    {
    	return view('School.Class.add_class');
    }


    public function store(Request $request)
    {
    	try{
    		DB::transaction(function() use($request){
    			// INSERT DATA IN  CLASS TABLE
    			DB::table('class')->insert([
    				'name'			=>	$request->name,
    				'institute_id'	=>	Session::get('institute_id'),
    			]);
    		});
    	}
    	catch(\Exception $e){
    		$a = explode('for', $e->errorInfo[2]);
    		return back()->with('warning',$a[0]);
    	}
    	return back()->with('success','Class Created Successfully !!');
    }

    public function index(ClassModel $class)
    {
    	$classes = $class->where('institute_id','=',Session::get('institute_id'))->get();
    	return view('School.Class.view_class',compact('classes'));
    }

    public function edit($id)
    {
    	$class = ClassModel::find($id)->first();
    	return view('School.Class.edit_class',compact('class'));
    }

    public function update(Request $request,$id)
    {
    	try{
    		DB::transaction(function() use($request,$id){
    			// INSERT DATA IN  CLASS TABLE
    			ClassModel::find($id)->update([
    				'name'			=>	$request->name,
    			]);
    		});
    	}
    	catch(\Exception $e){
    		$a = explode('for', $e->errorInfo[2]);
    		return back()->with('warning',$a[0]);
    	}
    	return redirect('class/index')->with('success','Class Updated Successfully !!');
    }

    public function delete($id)
    {
    	try{
    		DB::transaction(function() use($id){
    			// INSERT DATA IN  CLASS TABLE
    			ClassModel::find($id)->delete();
    		});
    	}
    	catch(\Exception $e){
    		$a = explode('for', $e->errorInfo[2]);
    		return back()->with('warning',$a[0]);
    	}
    	return back()->with('success','Class deleted Successfully');
    }
}
