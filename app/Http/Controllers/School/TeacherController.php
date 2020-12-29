<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validate;
use App\School\Teacher;
use App\User;
use Auth;
use DB;
use App\CommonModels\Role;
use Illuminate\Support\Str;
use File;
use Cache;
use App\Http\Traits\SuperAdminCacheTrait;
// use Illuminate\Support\Facades\Log;
// Log::info('Showing the user profile for user: '.$id);


class TeacherController extends Controller
{
    use SuperAdminCacheTrait;

    public function create(){
    	return view('School.Teacher.add_teacher');
    }

    public function store(Request $request){
       $validated = $request->validate([
           'name'       =>'required|max:255',
           'phone_no'   =>'required',
           'password'   =>'required|min:8',
           'email'      =>'required|email|unique:add_teacher',
           'id_proof'   =>'required',
        ]);
        
        if($validated){
              try{
                DB::transaction(function() use($request){

                    $institute = Cache::get('school', function(){
                      return DB::table('add_school')->get();
                    });
                    dd($institute);
                    $institute->name = Str::slug($institute->name);
                    $institute = Cache::get('school');
                    // Insert Image
                    global $filename;
                    if($request->has('image')){
                        $file = $request->file('image');
                        $filename = time().'.'.$request->image->extension().'.'.'teacher';
                        $file->move("schools/{$institute->name}/teachers/",$filename);
                    }
                    // Store data
                    $teacher = DB::table('add_teacher')->insertGetId([
                      'name'         =>$request->name,
                      'phone_no'     =>$request->phone_no,
                      'address'      =>$request->address,
                      'city'         =>$request->city,
                      'state'        =>$request->state,
                      'pincode'      =>$request->pin_code,
                      'institute_id' =>$institute->id,
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
                dd($e);
                $a = explode('at',  $e->errorInfo[2]);
                $a = explode('at', $e->errorInfo[2]);
                 //TO CHECK WHAT ERROR MESSAGE WAS THERE
                return back()->with('warning',$a[0]);
              }
        }else{
            return back()->with('errors',$validated->messages()->get('*'));
        }
    	return back()->with('success', 'Teacher has been added sucessfully..!!');
    }

    public function index(){
       
        $teachers = Teacher::where('institute_id', '=', Auth::user()->user_type_id);
        return view('School.Teacher.view_teacher', compact('teachers'));

    }

    public function show($id){

        $teacher = Teacher::find($id);
        $school_name = Cache::get('school_name_slug');
        return view('School.Teacher.view_single_teacher' , compact('teacher','school_name'));

    }

    public function edit($id){
        $teacher = Teacher::find($id);
        return view('School.Teacher.edit_teacher', compact('teacher'));
    }

    public function update(Request $request, $id){
         $validated = $request->validate([
           'name'       =>'required|max:255',
           'phone_no'   =>'required',
           'password'   =>'required|min:6',
           'email'      =>'required|email',
           'id_proof'   =>'required',
        ]);

        
        if($validated){

             try{
               DB::transaction(function() use($request, $id){
                global $filename;
                $school_name = Cache::get('school_name_slug');
                // Image Update
                if($request->hasfile('image')){
                    // TO DELETE EXISTING IMAGE IN STORAGE
                    if(File::exists(public_path('schools/{$school_name}/teachers/'.$request->current_image))){
                        File::delete(public_path('schools/{$school_name}/teachers/'.$request->current_image));
                    }
                    
                    // CREATING IMAGE FILE
                    $file = $request->file('image');
                    $filename = time().'.'.$request->image->extension().'.'.'teacher';
                    $file->move("schools/{$school_name}/teachers/",$filename);
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
                        'password'  =>  bcrypt($request['password'])
                    ]);
                }
            });
            }
            catch(\Exception $e){
            $a = explode('for', $e->errorInfo[2]);
             //TO CHECK WHAT ERROR MESSAGE WAS THERE
            return back()->with('warning',$a[0]);
            }
           
        }else{
              
              return back()->with('errors',$validated->messages()->get('*'));
         }
        return redirect('teacher/index')->with('success', 'Teacher has been updated');
    }

    public function delete($id){
        try{
            DB::transaction(function() use($id){
              $school_name = Cache::get('school_name_slug');
              $image = Teacher::where('id',$id)->first()->teacher;

               // TO DELETE AN EXISTING IMAGE
                if(File::exists(public_path('schools/{$school_name}/teachers/'.$image))){
                 File::delete(public_path('schools/{$school_name}/teachers/'.$image));
                }
                
                User::where('user_type_id',$id)->delete();
                Teacher::find($id)->delete();
            });
        }catch(\Exception $e){
            return back()->with('success', 'Teacher deleted sucessfully');
        }
    }

    public function TeacherStatus(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        $Teacher = Teacher::find($id)->update([
            'status' => $status,
        ]);
        $user = User::where('user_type_id', $id)->update([
            'status' => $status,
        ]);
        return true;
    }
}

