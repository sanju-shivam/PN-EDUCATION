<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Add_School;
use App\School\Teacher;
use App\CommonModels\Role;
use App\user;
use Auth;
use Illuminate\Support\Facades\Validate;
use Illuminate\Support\Facades\DB;
use File;
use Str;
use Storage;
use Carbon\Carbon;
use Cache;

class SchoolController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $schools = Cache::remember('all-schools',60*60,function(){
           return Add_School::all();
       });
       return view('SuperAdmin.School.View_School', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('SuperAdmin.School.Add_School');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
           'name'       =>'required|max:255',
           'email'      =>'required|email|unique:users',
           'phone_no'   =>'required|max:10',
           'password'   =>'required|min:8',
           'board_name' =>'required'
        
        ]);
          
        if($validated){
            try{
                DB::transaction(function() use($request){
                    // Insert Image
                    global $filename;
                    $school_name =  Str::slug($request->name);
                    if($request->has('logo')){
                        $file = $request->file('logo');
                        $filename= time().'.'.$request->logo->extension().'.'.'logo';
                        $file->move("schools/{$school_name}/logo/",$filename);
                    }
                    // Store data
                    $school =DB::table('add_school')->insertGetId([
                        'name'          =>  $request->name,
                        'logo'          =>  $filename,
                        'address'       =>  $request->address,
                        'city'          =>  $request->city,
                        'state'         =>  $request->state,
                        'pin_code'      =>  $request->pin_code,
                        'phone_no'      =>  $request->phone_no,
                        'email'         =>  $request->email,
                        'password'      =>  bcrypt($request->password),
                        'affilation_no' =>  $request->affilation_no,
                        'board_name'    =>  $request->board_name,
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now(),
                    ]);
                    // Insert data in user table
                    $school = DB::table('users')->insert([
                        'name'     => $request->name,
                        'email'    => $request->email,
                        'password' => bcrypt($request->password),
                        'role_id'  => Role::select('id')->where('name', 'School')->first()->id,
                        'user_type_id' =>$school,
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now(),
                    ]);

                });
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
        return redirect('school/create')->with('success', 'School has been Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $school = Add_School::find($id);
        
        $teacher_count = Cache::remember('teacher_count-'.$id,60*60,function(){
            return Teacher::where('institute_id',$id)->count();
        });

        return view('SuperAdmin.School.Show_School', compact('school','teacher_count'));
    }

    /**
     * Show the form for editing the specified resource.
    
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $school = Add_School::find($id);
        return view('SuperAdmin.School.Edit_School', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated =$request->validate([
           'name'       =>'required|max:255',
           'phone_no'   =>'required|min:10|max:10',
           'board_name' =>'required'
        
        ]);
        
        if($validated){

         try{
             DB::transaction(function() use($request,$id){
            // Image update
            global $filename;
            $school_name =  Str::slug($request->name);
        
            if($request->hasfile('logo')){
                //TO DELETE EXISTING IMAGE IN STORAGE 
                if(File::exists(public_path("schools/{$school_name}/logo/".$request->current_logo))){
                    File::delete(public_path("schools/{$school_name}/logo/".$request->current_logo));
                    // Add_School::where('id',$id)->delete();
                }
                // CREATING IMAGE FILE
                    $file = $request->file('logo');
                    $filename= time().'.'.$request->logo->extension().'.'.'logo';
                    $file->move("schools/{$school_name}/logo/",$filename);
            }
            else{
                $filename = $request['current_logo'];
            }

            // Update School
            Add_School::find($id)->update([
                'logo'         =>$filename,
                'name'         =>$request['name'],
                'address'      =>$request['address'],
                'city'         =>$request['city'],
                'state'        =>$request['state'],
                'pin_code'     =>$request['pin_code'],
                'phone_no'     =>$request['phone_no'],
                'affilation_no'=>$request['affilation_no'],
                'board_name'   =>$request['board_name'],
                'created_at'    =>  Carbon::now(),
                'updated_at'    =>  Carbon::now(),
            ]);

            if($request->has('password')){
                Add_School::find($id)->update([
                    'password'=>bcrypt($request['password']),
                ]);
                User::where('user_type_id',$id)->update([
                    'password'  =>  bcrypt($request['password']),
                    'created_at'    =>  Carbon::now(),
                    'updated_at'    =>  Carbon::now(),
                ]);
            }
         });
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
            
        }else{
          return back()->with('errors',$validated->messages()->get('*'));

        }
      
        return redirect('school')->with('success', 'School has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try{
            DB::transaction(function() use ($id){
                $image = Add_School::select('logo','name')->where('id',$id)->first();
                $school_name =  Str::slug($image->name);
                    //TO DELETE EXISTING IMAGE IN STORAGE 
                    if(File::exists(public_path('schools/'.$school_name.'/logo/'.$image->logo))){
                        File::delete(public_path('schools/'.$school_name.'/logo/'.$image->logo));
                    }
                User::where('user_type_id',$id)->where('role_id','=',Role::where('name','School')->first()->id)->delete();
                Add_School::find($id)->delete();
            });
        }
        catch(\Exception $e){
            return back()->with('warning','Error Occour');
        }
        
        return back()->with('success', 'School deleted sucessfully!');
    }


    public function SchoolStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        $school = Add_School::find($id)->update([
            'status' => $status,
        ]);
        $user = User::where('user_type_id',$id)->update([
            'status' => $status,
        ]);

        return true;
    }
}
