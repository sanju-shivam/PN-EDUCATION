<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Time;
use DB;
use Carbon\Carbon;


class TimeController extends Controller
{
	
    public function create(){
    	return view('SuperAdmin.Time.add_time');
    }  

    public function store(Request $request){

    	 try{
    		  DB::transaction(function() use($request){
              // INSERT DATA IN TIME TABLE
    			   $time = DB::table('time')->insert([
    			     'time'       =>  $request->time,
    			     'created_at' =>  carbon::now(),
    			     'updated_at' =>  carbon::now(),
    			    ]);
    		    });
    	    }
    	    catch(\Exception $e){
    		     $a = explode('for', $e->errorInfo[2]);
    		     return back()->with('warning',$a[0]);
    	    }   	
    	return back()->with('success','Time inserted Successfully !!');
    	
    }

    public function index(){
    	$times = Time::all();
    	return view('SuperAdmin.Time.view_time', compact('times'));
    }

    public function edit($id){
    	$time =Time::find($id)->first();
    	return view('SuperAdmin.Time.edit_time', compact('time'));
    }

    public function update(Request $request, $id){
    	try{
    		  DB::transaction(function() use($request, $id){
              // UPDATE DATA IN TIME TABLE
    			    Time::find($id)->update([
    			     'time'       =>  $request->time,
    			     'created_at' =>  carbon::now(),
    			     'updated_at' =>  carbon::now(),
    			    ]);
    		    });
    	    }
    	    catch(\Exception $e){
    		     $a = explode('for', $e->errorInfo[2]);
    		     return back()->with('warning',$a[0]);
    	    }
    	return redirect('time/index')->with('success', 'Time Updated Successfully..!!');
    }

    public function delete($id){
    	 try{
               DB::transaction(function() use($id){
                  // DELETE DATA IN  TIME TABLE
                   Time::find($id)->delete();
                });
            }
            catch(\Exception $e){
                  $s = explode('for', $e->errorInfo[2]);
                 return back()->with('warning', $s[0]);
            }
        return redirect('time/index')->with('success', 'Time has been Deleted');
    }
}
