<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\request;
use App\School\Teacher;
use App\user;
use DB;
use App\CommonModels\Role;
use Auth;

class TeacherController extends Controller
{
    public function create(){
    	return view('School.Teacher.add_teacher');
    }

    public function store(request $request){
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
    			$teacher = Teacher::create([
    			  'name'         =>$request->name,
                  'phone_no'     =>$request->phone_no,
    	          'address'      =>$request->address,
    	          'city'         =>$request->city,
    	          'state'        =>$request->state,
    	          'pincode'      =>$request->pincode,
    	          'institute_id' =>auth::user()->id,
    	          'email'        =>$request->email,
    	          'image'        =>$filename,
    	          'id_proof'     =>$request->id_proof,
    	          'password'     =>bcrypt($request->password),
                ]);

    			// Insert data in user table
<<<<<<< HEAD
    			$teacher = User::insert([
    				'name'         =>$teacher->name,
    				'email'        =>$teacher->email,
    				'password'     =>$teacher->password,
    			   	'role_id'      =>Role::select('id')->where('name', 'Teacher')->first()->id,
=======
    			$user = User::insert([
    				'name'         =>$request->name,
    				'email'        =>$request->email,
    				'password'     =>bcrypt($request->password),
    			   	'role_id'      =>Role::where('name','Teacher')->first()->id,
>>>>>>> a950e1a181ffe77825a0409f224b097436cab340
    			   	'user_type_id' =>$teacher->id,
    			]);
    		});
    	}
    	catch(\Exception $e){
    		return back()->with('warning', $e->errorInfo[2]);
    	}
    	return redirect('/')->with('success', 'Teacher has been added sucessfully..!!');
    }

    public function index(){
        $teacher = add_teacher::all();
        return view('/', compact('teacher'));
    }

    public function show($id){
        $teacher = add_teacher::find($id);
        return view('/' , compact('teacher'));
    }

    public function edit($id){
        $teacher = add_teacher::find($id);
        return view('/', compact('teacher'));
    }

    public function update(request $request, $id){
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
            add_teacher::find($id)->update([
                'image'        =>$filename,
                'name'         =>$request['name'],
                'phone_no'     =>$request->phone_no,
                'address'      =>$request->address,
                'city'         =>$request->city,
                'state'        =>$request->state,
                'pincode'      =>$request->pincode,
                'password'     =>bcrypt($request->password)
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
            return back()->with('warning', $e->errorInfo[2]);
        }
        return redirect('/')->with('success', 'Teacher has been updated');

    }

    public function delete($id){
        try{
            DB::transaction(function() use($id){
               $image = add_teacher::where('id',$id)->first()->teacher;

               // TO DELETE AN EXISTING IMAGE
               if(File::exists(public_path('schools/teachers/'.$image))){
                 File::delete(public_path('schools/teachers/'.$image));
                }

                user::where('user_type_id',$id)->delete();
                add_teacher::find($id)->delete();
            });
        }catch(\Exception $e){
            return back()->with('success', 'Teacher deleted sucessfully');
        }
    }
}

