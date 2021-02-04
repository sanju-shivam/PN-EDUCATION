<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Time;
use DB;
use Carbon\Carbon;
use Auth;


class TimeController extends Controller
{
	
    public function create(){
    	return view('SuperAdmin.Time.add_time');
    }  

    public function store(Request $request){
    	   try{
                DB::transaction(function() use($request){
                // INSERT DATA IN TIME TABLE
    			     DB::table('time')->insert([
                        'start_time'    =>  $request->start_time,
                        'end_time'      =>  $request->end_time,
                        'institute_id'  =>  Auth::user()->user_type_id,
                        'created_at'    =>  carbon::now(),
                        'updated_at'    =>  carbon::now(),
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
    	return back()->with('success','Time inserted Successfully !!');
    	
    }

    public function index(){
    	$times = Time::all()->sortBy('start_time');;
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
                    'start_time'    =>  $request->start_time,
                    'end_time'      =>  $request->end_time,
                    'updated_at' =>  carbon::now(),
			    ]);
		    });
          return redirect('time/index')->with('success', 'Time has been Updated');
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

    public function delete($id){
    	 try{
                  // DELETE DATA IN  TIME TABLE
                   Time::find($id)->delete();
                   return redirect('time/index')->with('success', 'Time has been Deleted');
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
}
