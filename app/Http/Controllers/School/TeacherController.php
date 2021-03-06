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
use Carbon\Carbon;
use App\Exports\TeacherExport;
use App\Imports\TeacherImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TeacherExportSample;
use App\SuperAdmin\Add_School;
// use Illuminate\Support\Facades\Log;
// Log::info('Showing the user profile for user: '.$id);


class TeacherController extends Controller
{
    public function create()
    { 
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
                $user = Auth::user();
                DB::transaction(function() use($request,$user){

                    $institute = Cache::remember('school-'.$user->id, 60, function () use($user) {
                        return Add_School::select('id','name','email')->where('id',$user->user_type_id)->first();
                    });

                    $institute_name = Cache::remember('school_name_slug-'.$user->id,60,function() use($user){
                      return Str::slug(
                        Add_School::where('id',$user->user_type_id)
                        ->first()->name
                      );
                    });

                    // Insert Image
                    global $filename;
                    if($request->has('image')){
                        $file = $request->file('image');
                        $filename = time().'.'.$request->image->extension().'.'.'teacher';
                        $file->move("schools/{$institute_name}/teachers/",$filename);
                    }

                    // Store data
                    $teacher = DB::table('add_teacher')->insertGetId([
                      'name'         =>$request->name,
                      'phone_no'     =>$request->phone_no,
                      'address'      =>$request->address,
                      'city'         =>$request->city,
                      'state'        =>$request->state,
                      'pincode'      =>$request->pin_code,
                      'institute_id' =>Auth::user()->user_type_id,
                      'email'        =>$request->email,
                      'image'        =>$filename,
                      'id_proof'     =>$request->id_proof,
                      'password'     =>bcrypt($request->password),
                      'created_at'    =>  Carbon::now(),
                      'updated_at'    =>  Carbon::now(),
                    ]);

                    // Insert data in user table
                    $user = DB::table('users')->insert([
                        'name'         =>$request->name,
                        'email'        =>$request->email,
                        'password'     =>bcrypt($request->password),
                        'role_id'      =>Role::where('name','Teacher')->first()->id,
                        'user_type_id' =>$teacher,
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now(),
                    ]);
                });
                return back()->with('success', 'Teacher has been added sucessfully..!!');
              }
              catch(\Exception $e){
                  //TO CHECK WHAT ERROR MESSAGE WAS THERE
                  if(!empty($e->errorInfo[2])){
                    $a = explode('at',  $e->errorInfo[2]);
                    return back()->with('warning',$a[0]);
                  }
                  else if(!empty($e->getMessage())){
                    return back()->with('warning',$e->getMessage().'   at   '.$e->getline());  
                  }
                  return back()->with('warning','Error Occour Please try Again After Reloading Page');
              }
        }
        else{
          return back()->with('errors',$validated->messages()->get('*'));
        }
    }

    public function index(){
        $user_id = Auth::user();
        
        $school_cache = Cache::remember('school_name_slug-'.$user_id->id,60,function() use($user_id){
          return Str::slug(
            Add_School::where('id',$user_id->user_type_id)
            ->first()->name
          );
        });

        $teachers = Cache::remember('teachers-'.Cache::get('school_name_slug'.$user_id->id), 60*60, function () use($user_id) {
           return Teacher::where('institute_id', '=', $user_id->user_type_id)->get(); 
        });
        

        return view('School.Teacher.view_teacher', compact('teachers','school_cache'));
    }

    public function show($id){

        $user_id = Auth::user();

        $school_cache = Cache::remember('school_name_slug-'.$user_id->id,60,function() use($user_id){
          return Str::slug(
            Add_School::where('id',$user_id->user_type_id)
            ->first()->name
          );
        });

        $teacher = Cache::remember(
          'teachers-'.Cache::get('school_name_slug'.$user_id->id).'-'.$id,
           60*60, function () use($id,$user_id){
             return Teacher::where('institute_id',$user_id->user_type_id)->find($id);
        });

        return view('School.Teacher.view_single_teacher' , compact('teacher','school_cache'));
    }

    public function edit($id){
        $user = Auth::user();

        $school_cache = Cache::remember('school_name_slug-'.$user->id,60,function() use($user){
          return Str::slug(
            Add_School::where('id',$user->user_type_id)
            ->first()->name
          );
        });

        $teacher = Teacher::where('institute_id',$user->user_type_id)->find($id);

        Cache::remember('school-'.$user->id, 60, function () use($user) {
          return Add_School::select('id','name','email')
                  ->where('id',$user->user_type_id)
                  ->first();
        });

        return view('School.Teacher.edit_teacher', compact('teacher','school_cache'));
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
              $user = Auth::user();
              DB::transaction(function() use($request, $id,$user){

                global $filename;

                $institute_name = Cache::remember('school_name_slug-'.$user->id,60,function() use($user){
                  return Str::slug(
                    Add_School::where('id',$user->user_type_id)
                    ->first()->name
                  );
                });

                // Image Update
                if($request->hasfile('image')){
                    // TO DELETE EXISTING IMAGE IN STORAGE
                    if(File::exists(public_path('schools/'.$institute_name.'/teachers/'.$request->current_image))){
                        File::delete(public_path('schools/'.$institute_name.'/teachers/'.$request->current_image));
                    }
                    
                    // CREATING IMAGE FILE
                    $file = $request->file('image');
                    $filename = time().'.'.$request->image->extension().'.'.'teacher';
                    $file->move("schools/{$institute_name}/teachers/",$filename);
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
                    'updated_at'    =>  Carbon::now(),
                ]);


                // Update into user
                if($request->has('password')){
                    User::where('user_type_id',$id)->update([
                        'password'  =>  bcrypt($request['password']),
                        'updated_at'    =>  Carbon::now(),
                    ]);
                }
              });

              cache::pull('teachers-'.Cache::get('school_name_slug'.$user->id));
              Cache::pull('teachers-'.Cache::get('school_name_slug'.$user->id).'-'.$id);

              return redirect('teacher/index')->with('success', 'Teacher has been updated');
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

    public function delete($id){
        try{
          $user = Auth::user();
            DB::transaction(function() use($id,$user){

              $institute_name = Cache::remember('school_name_slug-'.$user->id,60,function() use($user){
                return Str::slug(
                  Add_School::where('id',$user->user_type_id)
                  ->first()->name
                );
              });

              $image = Teacher::where('id',$id)->first()->image;
               // TO DELETE AN EXISTING IMAGE
                if(File::exists(public_path('schools/'.$institute_name.'/teachers/'.$image))){
                 File::delete(public_path('schools/'.$institute_name.'/teachers/'.$image));
                }
                
                User::where('user_type_id',$id)->where('role_id','=',Role::where('name','Teacher')->first()->id)->delete();
                Teacher::find($id)->delete();
            });
            
            cache::pull('teachers-'.Cache::get('school_name_slug'.$user->id));
            return back()->with('success', 'Teacher has been deleted sucessfully..!!');
        }catch(\Exception $e){
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

    public function deleted_Teacher()
    {
        $teachers = Teacher::onlyTrashed()->where('institute_id',Auth::user()->user_type_id)->get();
        return view('School.Teacher.Deleted_Teacher', compact('teachers'));
    }

    public function permanent_delete($id)
    {
        Teacher::onlyTrashed()->find($id)->forceDelete();
        User::where('user_type_id',$id)->where('role_id','=',Role::where('name','Teacher')->first()->id)->forceDelete();
        return back()->with('success', 'Teacher has been Deleted Permanent');
    }


    public function restore($id)
    {
        Teacher::onlyTrashed()->find($id)->restore();
        User::where('user_type_id',$id)->where('role_id','=',Role::where('name','Teacher')->first()->id)->restore();
        return back()->with('success', 'Teacher has been Restored');
    }


    public function import_view()
    {
      return view('School.Teacher.teacher_bulk_upload');
    }

    public function teacher_bulk_upload(Request $request)
    {
      try{
        DB::transaction( function() use ($request){
          Excel::import(new TeacherImport,$request->file('file')); 
        });
        return back()->with('success');
      }
      catch(\Exception $e){
         if(!empty($e->errorInfo[2])){
            $a = explode(' at ',  $e->errorInfo[2]);
            return back()->with('warning',$a[0]);
          }
          else if(!empty($e->getMessage())){
            return back()->with('warning',$e->getMessage().'   at   '.$e->getline());  
          }
          return back()->with('warning','Error Occour Please try Again After Reloading Page');
      }
    }

    public function Export($value='')
    {
      return Excel::download(new TeacherExport, 'teacher.xlsx');
    }

    public function ExportSample($value='')
    {
      return Excel::download(new TeacherExportSample, 'Sample_teacher.xlsx');
    }
}

