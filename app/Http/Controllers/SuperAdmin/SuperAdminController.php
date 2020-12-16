<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Add_School;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
       $data = Add_School::all();
       return view('SuperAdmin/School/View_School', compact('data')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('SuperAdmin/School/Add_School');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $data = Add_School::all();

        // Insert Image
        $file = $request->file('logo');
         $filename = 'logo'.time().'.'.$request->logo->extension();
        // dd($file);
        // exit;
        $storage = storage_path('../public/uploads/schools/logo');
        $file->move($storage, $filename);
        $path = "/".$filename;

        // Store data
        $data = new Add_School;
        $data->name =$request->name;
        $data->logo = $path;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->pin_code = $request->pin_code;
        $data->phone_no = $request->phone_no;
        $data->email = $request->email;
        $data->affilation_no = $request->affilation_no;
        $data->board_name = $request->board_name;
        $data->status = $request->status;
        $data->role_id = 1;
        $data->save();
        // print_r($data);
        // die;
        return redirect('add_school');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Add_School::find($id);
        return view('SuperAdmin/School/Show_School', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $get = Add_School::find($id);
        return view('SuperAdmin/School/Edit_School', compact('get'));
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
        $filename = 'logo'.time().'.'.$request->logo->extension();
        $storage = storage_path('../public/uploads/schools/logo');
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
