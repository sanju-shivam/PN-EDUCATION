<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validate;
use Illuminate\Http\Request;
use App\SuperAdmin\Day;
use DB;
use Carbon\Carbon;

class DayController extends Controller
{
    public function create(){
    	return view('SuperAdmin.Day.add_day');
    }

    public function store(Request $request){
    	$validated =$request->validate([
    	  'name' => 'required|unique:day',
    	]);


    	if($validated){
    	 try{
    		  DB::transaction(function() use($request){
              // INSERT DATA IN DAY TABLE
    			   $day = DB::table('day')->insert([
    			     'name'       =>  $request->name,
    			     'created_at' =>  carbon::now(),
    			     'updated_at' =>  carbon::now(),
    			    ]);
    		    });
    	    }
    	    catch(\Exception $e){
    		     $a = explode('for', $e->errorInfo[2]);
    		     return back()->with('warning',$a[0]);
    	    }
    	}
    	else{  
    	   return back()->with('errors',$validated->messages()->get('*'));
    	}
    	
    	return back()->with('success','Day Created Successfully !!');
    	
    }

    public function index(){
    	$days = Day::all();
    	return view('SuperAdmin.Day.view_day', compact('days'));
    }

    public function edit($id){
    	$day =Day::find($id)->first();
    	return view('SuperAdmin.Day.edit_day', compact('day'));
    }

    public function update(Request $request, $id){
    	try{
    		  DB::transaction(function() use($request, $id){
              // UPDATE DATA IN DAY TABLE
    			    Day::find($id)->update([
    			     'name'       =>  $request->name,
    			     'created_at' =>  carbon::now(),
    			     'updated_at' =>  carbon::now(),
    			    ]);
    		    });
    	    }
    	    catch(\Exception $e){
    		     $a = explode('for', $e->errorInfo[2]);
    		     return back()->with('warning',$a[0]);
    	    }
    	return redirect('day/index')->with('success', 'Day Updated Successfully..!!');
    }

    public function delete($id){
    	 try{
            DB::transaction(function() use($id){
                // DELETE DATA IN  DAY TABLE
                 Day::find($id)->delete();
            });
        }
        catch(\Exception $e){
           $s = explode('for', $e->errorInfo[2]);
          return back()->with('warning', $s[0]);
        }
        return redirect('day/index')->with('success', 'Day has been Deleted');
    }

}
