<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Add_School;
use App\CommonModels\Role;
use App\user;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use File;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $schools = Add_School::all();
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
        $validated = Validator::make($request->all(),[
           'name'       =>'required|max:255',
           'email'      =>'required|email|unique:users',
           'phone_no'   =>'required',
           'password'   =>'required|max:8',
           'board_name' =>'required'
        
        ]);
        
        // dd($validated->messages()->get('*'));
        // exit;
        if($validated->fails()){
            // dd($validated->messages()->get('*'));
            return back()->with('errors', $validated->messages()->get('*'));
        }
        else{
        try{
            DB::transaction(function() use($request){
                // Insert Image
                global $filename;
                if($request->has('logo')){
                    $file = $request->file('logo');
                    $filename= time().'.'.$request->logo->extension().'.'.'logo';
                    $file->move('schools/logo/',$filename);
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
                ]);
                // Insert data in user table
                $school = DB::table('users')->insert([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => bcrypt($request->password),
                    'role_id'  => Role::select('id')->where('name', 'School')->first()->id,
                    'user_type_id' =>$school,
                ]);

            });
        }
        catch(\Exception $e){
            
            DB::rollback();
            $a = explode('for', $e->errorInfo[2]);
             //TO CHECK WHAT ERROR MESSAGE WAS THERE
            return back()->with('warning',$a[0]);
        }
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
        return view('SuperAdmin.School.Show_School', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
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
        //dd($request->logo);
        // $school = $request->all();
        try{
         DB::transaction(function() use($request,$id){
            // Image update
            global $filename;
            if($request->hasfile('logo')){
                //TO DELETE EXISTING IMAGE IN STORAGE 
                if(File::exists(public_path('schools/logo/'.$request->current_logo))){
                    File::delete(public_path('schools/logo/'.$request->current_logo));
                    // Add_School::where('id',$id)->delete();
                }
                // CREATING IMAGE FILE
                $file = $request->file('logo');
                $filename= time().'.'.$request->logo->extension().'.'.'logo';
                $file->move('schools/logo/',$filename);
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
                'password'     =>bcrypt($request['password']),
                'affilation_no'=>$request['affilation_no'],
                'board_name'   =>$request['board_name'],
            ]);

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
            return back()->with('warning', $a);
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
                $image = Add_School::where('id',$id)->first()->logo;

                    //TO DELETE EXISTING IMAGE IN STORAGE 
                    if(File::exists(public_path('schools/logo/'.$image))){
                        File::delete(public_path('schools/logo/'.$image));
                    }
                User::where('user_type_id',$id)->delete();
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
