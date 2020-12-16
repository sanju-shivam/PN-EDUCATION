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

        $data = Add_School::all();
        return view('SuperAdmin/School/Add_School', compact('data'));
              
        
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    $file = $request->file('logo');
         $filename = 'logo'.time().''.$request->logo->extension();
        // dd($file);
        // exit;
        $storage = storage_path('../uploads/schools/logo');
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
        return redirect('school_details', compact('data'));
        
        
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
        return view('SuperAdmin/School/Show_School', compact('data'))
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
        return view('SuperAdmin/School/Edit_School', compact('edit'));
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
        $edit = Add_School::find($request->id);
         $data->name =$request->name;

         // Image update
         if($request->hasfile('logo')){
        $file = $request->file('logo');
        $filename = 'logo'.time().'.'.$request->logo->extension();
        $storage = storage_path('../uploads/schools/logo');
        $file->move($storage, $filename);
        $path = "/".$filename;
    }else{
        $path = $data['current_logo'];
    }
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
        $update = $data->update();
        
        if($update){
           return redirect('school_details')->with('message', 'Details sucessfully updated');
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
