<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\SuperAdmin\Add_School;
use App\School\Teacher;
use Auth;
use App\CommonModels\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role_id == Role::where('name','SChool')->first()->id ){
            Session::put('institute_id',Add_School::find(Auth::user()->user_type_id)->first()->id);
        }
        $schools = Add_School::count();
        $teacher = Teacher::count();
        return view('home',compact('schools','teacher'));
    }

    public function logout()
    {
        Session::flush();
        return redirect('login');
    }
}
