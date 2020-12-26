<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function create()
    {
    	return view('School.Subject.Add_Subject')
    }

    public function store(Request $request)
    {
    	
    }
}
