<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Section;
use DB;
use Carbon\Carbon;

class SectionController extends Controller
{
    public function create(){
    	return view('SuperAdmin.Section.Add_Section');
    }

    public function store(Request $request){

    	try{
    		DB::transaction(function() use($request){
    			DB::table('section')->insert([
                  'name' =>$request->name,
                  'created_at' =>carbon::now(),
                  'updated_at' =>carbon::now(),
    			]);
    		});
    	}catch(\Exception $e){
             return back()->with('error', 'Section Not Added Successfully..!!');
    	}
         return view('SuperAdmin.Section.Add_Section');
    }

    public function index(){
      $sections = Section::all();
      return view('SuperAdmin.Section.View_Section', compact('sections'));
    }

    public function edit($id){
    	$section = Section::find($id)->first();
    	return view('SuperAdmin.Section.Edit_Section', compact('section'));
    }

    public function update(Request $request, $id){
    	try{
    		DB::transaction(function() use($request, $id){
    			//UPDATE DATA IN SECTION TABLE
    			Section::find($id)->update([
                   'name' => $request->name,
                   'created_at' =>carbon::now(),
                   'updated_at' =>carbon::now(),
    			]);
    		});
    	}catch(\Exception $e){
    		$a = explde('for', $e->errorInfo[2]);
    		return back()->with('warning', $a[0]);
    	}
    	return redirect('section/index')->with('success', 'Section Updated Successfully..!!');
    }

    public function delete($id){
        try{
            DB::transaction(function() use($id){
                // DELETE DATA IN  SECTION TABLE
                 Section::find($id)->delete();
            });
        }
        catch(\Exception $e){
           $s = explode('for', $e->errorInfo[2]);
          return back()->with('warning', $s[0]);
        }
        return redirect('section/index')->with('success', 'Section has been Deleted');
    }
}
