<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\School\Teacher;
use DB;
use App\CommonModels\Role;
use File;
use Session;

class TeacherController extends Controller
{
    public function create(){
        
    	return view('School.Teacher.add_teacher');
    }

    public function store(Request $request){

        // dd($request->all());
    	try{
    		DB::transaction(function() use($request){
    			// Insert Image
    			global $filename;
    			if($request->has('image')){
    				$file = $request->file('image');
    				$filename = time().'.'.$request->image->extension().'.'.'teacher';
    				$file->move('schools/teachers/',$filename);
    			}
                
    			// Store data
    			$teacher = DB::table('add_teacher')->insertGetId([


    			  'name'         =>$request->name,
                  'phone_no'     =>$request->phone_no,
    	          'address'      =>$request->address,
    	          'city'         =>$request->city,
    	          'state'        =>$request->state,
    	          'pincode'      =>$request->pin_code,
    	          'institute_id' =>Session::get('institute_id'),
    	          'email'        =>$request->email,
    	          'image'        =>$filename,
    	          'id_proof'     =>$request->id_proof,
    	          'password'     =>bcrypt($request->password),
                ]);

    			// Insert data in user table
    			$user = DB::table('users')->insert([

                    'name'         =>$request->name,
                    'email'        =>$request->email,
                    'password'     =>bcrypt($request->password),
                    'role_id'      =>Role::where('name','Teacher')->first()->id,
                    'user_type_id' =>$teacher,
                ]);
    		});
    	}
    	catch(\Exception $e){
    		$a = explode('for', $e->errorInfo[2]);
             //TO CHECK WHAT ERROR MESSAGE WAS THERE
            return back()->with('warning',$a[0]);
    	}
    	return back()->with('success', 'Teacher has been added sucessfully..!!');
    }

    public function index(){
       
        $teachers = Teacher::all();
        return view('School.Teacher.view_teacher', compact('teachers'));

    }

    public function show($id){
        $teacher = Teacher::find($id);
        return view('School.Teacher.view_single_teacher' , compact('teacher'));

    }

    public function edit($id){
        $teacher = Teacher::find($id);
        return view('School.Teacher.edit_teacher', compact('teacher'));
    }

    public function update(Request $request, $id){
       try{
            DB::transaction(function() use($request, $id){
                global $filename;
                // Image Update
                if($request->hasfile('image')){
                    // TO DELETE EXISTING IMAGE IN STORAGE
                    if(File::exists(public_path('schools/teachers/'.$request->current_image))){
                        File::delete(public_path('schools/teachers/'.$request->current_image));
                    }
                    // CREATING IMAGE FILE
                    $file = $request->file('image');
                    $filename = time().'.'.$request->image->extension().'.'.'teacher';
                    $file->move('schools/teachers/', $filename);
                }
                else{
                    $filename = $request['current_image'];
                }

                // Update School
                Teacher::find($id)->update([
                    'image'        =>   $filename,
                    'name'         =>   $request['name'],
                    'phone_no'     =>   $request->phone_no,
                    'address'      =>   $request->address,
                    'city'         =>   $request->city,
                    'state'        =>   $request->state,
                    'pincode'      =>   $request->pin_code,
                    'password'     =>   bcrypt($request->password),
                    'id_proof'     =>   $request->id_proof,
                    'email'        =>   $request->email,
                ]);


                // Update into user
                if($request->has('password')){
                    User::where('user_type_id',$id)->update([
                        'password'  =>  $request['password']
                    ]);
                }
            });
        }
        catch(\Exception $e){
            // dd($e);
            $a = explode('for', $e->errorInfo[2]);
             //TO CHECK WHAT ERROR MESSAGE WAS THERE
            return back()->with('warning',$a[0]);
        }
        return redirect('teacher/index')->with('success', 'Teacher has been updated');
    }

    public function delete($id){
        try{
            DB::transaction(function() use($id){
               $image = Teacher::where('id',$id)->first()->teacher;

               // TO DELETE AN EXISTING IMAGE
                if(File::exists(public_path('schools/teachers/'.$image))){
                 File::delete(public_path('schools/teachers/'.$image));
                }
                
                User::where('user_type_id',$id)->delete();
                Teacher::find($id)->delete();
            });
        }catch(\Exception $e){
            return back()->with('success', 'Teacher deleted sucessfully');
        }
    }
}

