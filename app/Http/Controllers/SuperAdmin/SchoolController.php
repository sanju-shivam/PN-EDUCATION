<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Add_School;
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
                
                // Insert Image
                $file = $request->file('logo');
                $filename = time().'.'.'logo'.$request->logo->extension();
                $storage = storage_path('public/uploads/schools/logo');
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
                    'affilation_no' =>  $request->affilation_no,
                    'board_name'    =>  $request->board_name,
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
    public function update(Request $request)
    { 
        $get = Add_School::find($request->id);
        //  dd($get);
        // exit;
        $get->name =$request->name;
        
         // Image update
         if($request->hasfile('logo')){
        $file = $request->file('logo');
        $filename = time().'.'.'logo'.$request->logo->extension();
        $storage = storage_path('public/uploads/schools/logo');
        $file->move($storage, $filename);
        $path = "/".$filename;
        }else{
            $path = $data['current_logo'];
        }

        // Update 
        $get->logo = $path;
        $get->address = $request->address;
        $get->city = $request->city;
        $get->state = $request->state;
        $get->pin_code = $request->pin_code;
        $get->phone_no = $request->phone_no;
        $get->email = $request->email;
        $get->affilation_no = $request->affilation_no;
        $get->board_name = $request->board_name;
        $get->status = $request->status;
        $updated =$get->update();
        
        if($updated){
           // return redirect('school_details')->with('message', 'Details sucessfully updated');
        
        return view('SuperAdmin/School/Edit_School');  
        }
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
