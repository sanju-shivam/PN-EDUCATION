<?php

namespace App\Http\Controllers\SuperAdmin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\ClassModel;
use DB;
use Carbon\Carbon;
use App\SuperAdmin\Add_School;

class ClassController extends Controller
{
    public function create()
    {
    	return view('SuperAdmin.Class.add_class');
    }


    public function store(Request $request)
    {
    	try{
    		DB::transaction(function() use($request){
    			// INSERT DATA IN  CLASS TABLE
    			DB::table('class')->insert([
    				'name'			=>	$request->name,
                    'created_at'    =>  Carbon::now(),
                    'updated_at'    =>  Carbon::now(),
    			]);
    		});
    	}
    	catch(\Exception $e){
    		$a = explode('for', $e->errorInfo[2]);
    		return back()->with('warning',$a[0]);
    	}
    	return back()->with('success','Class Created Successfully !!');
    }

    public function index()
    {
    	$classes = ClassModel::all();
    	return view('SuperAdmin.Class.view_class',compact('classes'));
    }

    public function edit($id)
    {
    	$class = ClassModel::find($id)->first();
    	return view('SuperAdmin.Class.edit_class',compact('class'));
    }

    public function update(Request $request,$id)
    {
    	try{
    		DB::transaction(function() use($request,$id){
    			// INSERT DATA IN  CLASS TABLE
    			ClassModel::find($id)->update([
    				'name'			=>	$request->name,
                    'created_at'    =>  Carbon::now(),
                    'updated_at'    =>  Carbon::now(),
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
    			ClassModel::find($id)->forceDelete();
    		});
    	}
    	catch(\Exception $e){
    		$a = explode('for', $e->errorInfo[2]);
    		return back()->with('warning',$a[0]);
    	}
    	return back()->with('success','Class deleted Successfully');
    }

    public function deleted_School()
    {
        $schools = Add_School::onlyTrashed()->get();
        return view('SuperAdmin.School.Deleted_School', compact('schools'));
    }

    public function permanent_delete($id)
    {
        Add_School::onlyTrashed()->find($id)->forceDelete();
        User::where('user_type_id',$id)->where('role_id','=',Role::where('name','School')->first()->id)->forceDelete();
        return back()->with('success', 'School has been Deleted Permanent');
    }


    public function restore($id)
    {
        Add_School::onlyTrashed()->find($id)->restore();
        User::where('user_type_id',$id)->where('role_id','=',Role::where('name','School')->first()->id)->restore();
        return back()->with('success', 'School has been Restored');
    }
}
