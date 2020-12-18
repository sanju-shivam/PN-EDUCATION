<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Add_School;
use App\user;
use DB;

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
        try{
            DB::transaction(function() use($request){

             // Insert data in user table
             $school = User::insert([
               'name'     => $request->name,
               'email'    => $request->email,
               'password' => bcrypt($request->password),
               'role_id'  =>  1,
             ]);
                
                // Insert Image
                $file = $request->file('logo');
                $filename = time().'.'.'logo'.$request->logo->extension();
                $storage = storage_path('../public/uploads/schools/logo');
                $file->move($storage, $filename);
                $path = $filename;

                // Store data
                $school = Add_School::create([
                    'name'          =>  $request->name,
                    'logo'          =>  $path,
                    'address'       =>  $request->address,
                    'city'          =>  $request->city,
                    'state'         =>  $request->state,
                    'pin_code'      =>  $request->pin_code,
                    'phone_no'      =>  $request->phone_no,
                    'email'         =>  $request->email,
                    'password'      =>  bcrypt($request->password),
                    'affilation_no' =>  $request->affilation_no,
                    'board_name'    =>  $request->board_name,
                    'role_id'       =>  1,
                ]);

            });
        }
        catch(\Exception $e){
            return $e;
        }

        return redirect('school/create');
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
    {  echo"hh";
    die;
         // Image update
         if($request->hasfile('logo')){
        $file = $request->file('logo');
        $filename = time().'.'.'logo'.$request->logo->extension();
        $storage = storage_path('public/uploads/schools/logo');
        $file->move($storage, $filename);
        $path = "/".$filename;
        }else{
            $path = $school['current_logo'];
        }

        // Update School
        Add_School::where(['id' =>$id])->update([
            'logo'         =>$path,
            'address'      =>$school['address'],
            'city'         =>$school['city'],
            'state'        =>$school['state'],
            'pin_code'     =>$school['pin_code'],
            'phone_no'     =>$school['phone_no'],
            'email'        =>$school['email'],
            'password'     =>bcrypt($school['password']),
            'affilation_no'=>$school['affilation_no'],
            'board_name'   =>$School['board_name'],
            'status'       =>$school['status'],
            'role_id'      =>  1,
        ]);
        return redirect()->back()->with('flash_message_success', 'School has been updated');
        $school = Add_School::where(['id' =>$id])->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
       Add_School::where(['id'=>$id])->delete();
        return redirect('/school_details')->with('message', 'record deleted sucessfully!');

    }
}
