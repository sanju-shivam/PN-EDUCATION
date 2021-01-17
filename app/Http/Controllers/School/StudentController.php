<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cache;
use App\School\Student;
use DB;
use Illuminate\Support\Facades\validate;
use Auth;
use Carbon\Carbon;
use File;
use App\CommonModels\Role;
use App\SuperAdmin\ClassModel;
use App\School\Class_Student;
use App\User;

class StudentController extends Controller
{
    public function create()
    {
    	$classes = ClassModel::all();
    	return view('School.Student.create_student',compact('classes'));
    }

    public function store(Request $request){
       $validated = $request->validate([
           'name'       =>'required|max:255',
           'phone_no'   =>'required',
           'password'   =>'required|min:8',
           'email'      =>'required|email|unique:students',
           'id_proof'   =>'required',
           'gender'		=>'required',
           'class'		=>'required',
        ]);
    
    	if($validated){
          try{
              DB::transaction(function() use($request){

                  $institute 		= Cache::get('school');
                  $institute_name = Cache::get('school_name_slug');

                  // Insert Image
                  global $filename;
                  if($request->has('image')){
                      $file = $request->file('image');
                      $filename = time().'.'.$request->image->extension().'.'.'student';
                      $file->move("schools/{$institute_name}/students/",$filename);
                  }
                  
                  // Store data
                  $student = DB::table('students')->insertGetId([
                    'name'         =>		$request->name,
                    'phone_no'     =>		$request->phone_no,
                    'address'      =>		$request->address,
                    'city'         =>		$request->city,
                    'state'        =>		$request->state,
                    'pincode'      =>		$request->pin_code,
                    'institute_id' =>		Auth::user()->user_type_id,
                    'email'        =>		$request->email,
                    'image'        =>		$filename,
                    'id_proof'     =>		$request->id_proof,
                    'password'     =>		bcrypt($request->password),
                    'gender'		 =>		$request->gender,
                    'DOB'			 =>		$request->DOB,
                    'created_at'   =>		Carbon::now(),
                    'updated_at'   =>		Carbon::now(),
                  ]);

                  DB::table('class__students')->insert([
                  	'institute_id'	=>	Auth::user()->user_type_id,
                  	'class_id'		=>	$request->class,
                  	'student_id'	=>	$student,
                    'created_at'   => Carbon::now(),
                    'updated_at'   => Carbon::now(),
                  ]);

                  // Insert data in user table
                  $user = DB::table('users')->insert([
                      'name'         =>	$request->name,
                      'email'        =>	$request->email,
                      'password'     =>	bcrypt($request->password),
                      'role_id'      =>	Role::where('name','Student')->first()->id,
                      'user_type_id' =>	$student,
                      'created_at'   =>	Carbon::now(),
                      'updated_at'   =>	Carbon::now(),
                  ]);
              });
              return back()->with('success', 'Student has been added sucessfully..!!');
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
  		else{
  			return back()->with('errors',$validated->messages()->get('*'));
  		}
    }

    public function index()
    {
    	$students = Student::where('institute_id',Auth::user()->user_type_id)->get();
    	return view('School.Student.view_student',compact('students'));
    }

    public function show($id)
    {
      // $id = Student::where('id',$id)->first()->Class[0]->class_id;
      // dd($id);
    	$class_id = Class_Student::where('institute_id',Auth::user()->user_type_id)->where('student_id',$id)->first()->class_id;
    	$class_name = ClassModel::find($class_id)->first()->name;
    	$student = Student::where('id',$id)->first();

    	return view('School.Student.view_single_student',compact('student','class_name'));
    }

    public function edit($id)
    {
    	$classes = ClassModel::all();
    	$student = Student::where('id',$id)->first();
    	$class_id = Class_Student::where('institute_id',Auth::user()->user_type_id)->where('student_id',$id)->first()->class_id;
    	return view('School.Student.edit_student',compact('student','classes','class_id'));
    }

    public function delete($id)
    {
        $institute_name = Cache::get('school_name_slug');
        $image = Student::where('id',$id)->first()->image;

        // TO DELETE AN EXISTING IMAGE
        if(File::exists(public_path('schools/'.$institute_name.'/students/'.$image))){
         File::delete(public_path('schools/'.$institute_name.'/students/'.$image));
            Student::where('id',$id)->update([
              'image' => null
         ]  );
        }
                
        $user = User::where('user_type_id',$id)->where('role_id','=',Role::where('name','Student')->first()->id)->delete();
      	
        $student = Student::find($id)->delete();
        $ClassStudent = Class_Student::where('institute_id',Auth::user()->user_type_id)->where('student_id',$id)->delete();
        if($student and $ClassStudent and $user){
            return back()->with('success','Studeent deleted SuccessFully');
        }
        
        return back()->with('warning','Error in deleting Studeent');

    }

    public function StudentStatus(Request $request)
    {
      	$id = $request->get('id');
        $status = $request->get('status');
        $Teacher = Student::find($id)->update([
            'status' => $status,
        ]);
        $user = User::where('user_type_id', $id)->update([
            'status' => $status,
        ]);
        return true;
    }


    public function update(Request $request ,$id)
    {
        $validated = $request->validate([
           'name'       =>'required|max:255',
           'phone_no'   =>'required',
           'id_proof'   =>'required',
           'gender'     =>'required',
        ]);

        if($validated){
          try{
            global $filename;
            $institute_name = Cache::get('school_name_slug');
            // Image Update
            if($request->hasfile('image')){
                // TO DELETE EXISTING IMAGE IN STORAGE
                if(File::exists(public_path('schools/{$institute_name}/students/'.$request->current_image))){
                    File::delete(public_path('schools/{$institute_name}/students/'.$request->current_image));
                }
                
                // CREATING IMAGE FILE
                $file = $request->file('image');
                $filename = time().'.'.$request->image->extension().'.'.'student';
                $file->move("schools/{$institute_name}/students/",$filename);
            }
            else{
                $filename = $request['current_image'];
            }

            Student::find($id)->update([
                  'name'         =>   $request->name,
                  'phone_no'     =>   $request->phone_no,
                  'address'      =>   $request->address,
                  'city'         =>   $request->city,
                  'state'        =>   $request->state,
                  'pincode'      =>   $request->pin_code,
                  'image'        =>   $filename,
                  'id_proof'     =>   $request->id_proof,
                  'gender'       =>   $request->gender,
                  'DOB'          =>   $request->DOB,
                  'updated_at'   =>   Carbon::now(),
            ]);

            // update ONLY WHEN NEW CLASS IS PROVIED BY USER
            if(!empty($request->new_class)){
              Class_Student::where('institute_id',Auth::user()->user_type_id)->where('student_id',$id)->update([
                  'class_id'    =>  $request->new_class,
                  'updated_at'   => Carbon::now(),
              ]);
            }

            // Update into user
            if($request->has('password')){
                Student::find($id)->update([
                  'password'  =>  bcrypt($request->password),
                ]);
                User::where('user_type_id',$id)->update([
                    'password'  =>  bcrypt($request['password']),
                    'updated_at'    =>  Carbon::now(),
                ]);
            }


            return redirect('student/index')->with('success','Student Updated SuccessFully');
          }
          catch(\Exception $e){
              //dd($e->getline());
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
        else{
          return back()->with('errors',$validated->messages()->get('*'));
        }
    }


    public function deleted_students()
    {
        $students = Student::onlyTrashed()->where('institute_id',Auth::user()->user_type_id)->get();
        return view('School.Student.Deleted_Student',compact('students'));
    }

    public function restore_student($id)
    {
        $user = User::onlyTrashed()->where('user_type_id',$id)->where('role_id','=',Role::where('name','Student')->first()->id)->restore();
        $student = Student::onlyTrashed()->find($id)->restore();

        DB::transaction(function() use($id){
            DB::table('class__students')->insert([
                    'institute_id'  =>  Auth::user()->user_type_id,
                    'class_id'      =>  0,
                    'student_id'    =>  $id,
                    'created_at'    =>  Carbon::now(),
                    'updated_at'    =>  Carbon::now(),
            ]);
        });

        if($student and $user){
            return back()->with('success','Studeent Restored SuccessFully');
        }
        
        return back()->with('warning','Error in Restoring Studeent');
    }

    public function permanent_delete($id)
    {
        $user = User::onlyTrashed()->where('user_type_id',$id)->where('role_id','=',Role::where('name','Student')->first()->id)->forceDelete();
        $student = Student::onlyTrashed()->find($id)->forceDelete();

        if($student and $user){
            return back()->with('success','Studeent Permanently Deleted');
        }
        
        return back()->with('warning','Error in Permanent Deleting Studeent');
    }
}
