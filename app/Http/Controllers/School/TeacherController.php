<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\request;
use App\School\Teacher;
use App\user;
use DB;

class TeacherController extends Controller
{
    public function create(){
    	return view('School.Teachers.add_teacher');
    }

    public function store(request $request){
    	try{
    		DB::transaction(function() use($request){
    			// Insert Image
    			global $filename;
    			if($request->has('image')){
    				$file = $request->file('image');
    				$filename = time().'.'.$request->image->extension().'.'.'image';
    				$file->move('schools/teachers/',$filename);
    			}

    			// Store data
    			$teacher = Teacher::create([
    			  'name'         =>$request->name,
                  'phone_no'     =>$request->phone_no,
    	          'address'      =>$request->address,
    	          'city'         =>$request->city,
    	          'state'        =>$request->state,
    	          'pincode'      =>$request->pincode,
    	          'institute_id' =>$request->institute_id,
    	          'email'        =>$request->email,
    	          'image'        =>$filename,
    	          'id_proof'     =>$request->id_proof,
    	          'password'     =>bcrypt($request->password)
    	      ]);

    			// Insert data in user table
    			$teacher = User::insert([
    				'name'         =>$teacher->name,
    				'email'        =>$teacher->email,
    				'password'     =>$teacher->password,
    			   	'role_id'      =>0,
    			   	'user_type_id' =>$teacher->id,

    			]);
    		});
    	}
    	catch(\Exception $e){
    		return back()->with('warning', $e->errorInfo[2]);
    	}
    	return redirect('')->with('success', 'Teacher has been added sucessfully..!!');
    }
}
