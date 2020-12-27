<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SubjectController extends Controller
{
    public function create()
    {
    	return view('SuperAdmin.Subject.Add_Subject');
    }

    public function store(Request $request)
    {
    	try{
    		DB::transaction(function () use ($request){
    			DB::table('subject')->insert([
    				'name'	=>	$request->name
    			]);
    		});
    	}
    	catch(\Exception $e){
    		return back()->with('error','Subject Not Added SuccsFully');
    	}
    }

    public function index()
    {
    	# code...
    }
}
