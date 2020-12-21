<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Add_School;
use App\SuperAdmin\Add_Admin;
use App\User;
use DB;

class AdminController extends Controller
{
    public function create()
    {
        //LIST OF SCHOOLS
    	$schools	 =	Add_School::select('name','id')->get();
    	return view('SuperAdmin.Admin.Add_Admin',compact('schools'));
    }

    public function store(Request $request)
    {
    	$path = null;
    	if($request->has('profile_image')){
    		$file = $request->file('profile_image');
                $filename = time().'.'.'profile_image'.$request->profile_image->extension();
                $storage = storage_path('../public/uploads/schools/profile_image');
                $file->move($storage, $filename);
                $path = $filename;
        }
        try{
            DB::transaction(function () {
                //Creating Admin in admin Table
                $admin 	=	Add_Admin::create([
                    'name'			=>	$request->name,
                    'institute_id'	=>	$request->institute_id,
                    'email'			=>	$request->email,
                    'phone_no'		=>	$request->phone_no,
                    'address'		=>	$request->address,
                    'image'			=>	$path,
                    'status'		=> 1
                ]);
                // Creating Admin login
                $user	=	User::create([
                    'name'		    =>	$request->name,
                    'email'		    =>	$request->email,
                    'password'	    =>	bcrypt($request->password),
                    'role_id'	    =>	2,
                    'user_type_id'  =>  $admin->id,
                    'status'	    =>	1,
                ]);
                if($admin and $user){
                    return back()->with('success','Admin Added Successfully');
                }
            });
        }
        catch(\Exception $e){
            return back()->with('warning','Admin NOT Created Some Error Occour');
        }
    }

    public function index()
    {
        $admins =   Add_Admin::all();
        return view('SuperAdmin.Admin.View_All_Admin',compact('admins'));
    }
}
