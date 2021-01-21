<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\School\Teacher;
use App\SuperAdmin\ClassModel;
use App\SuperAdmin\Day;


class TimeTableSchool extends Controller
{
    // public function art()
    // {
    //     Artisan::call("create:timetable");
    //     Artisan::call("migrate");
    // }

    public function create()
    {
    	$days	 	= 	Day::all();
    	$classes 	= 	ClassModel::all();
    	$Teachers 	= 	Teachers::where('institutuin_id',Auth::user()->user_type_id)
    					->get();
    	return view('');
    }
}
