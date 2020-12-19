<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin\Add_School;

class AdminController extends Controller
{
    public function create()
    {
    	return view('SuperAdmin.Admin.Add_Admin');
    }
}
