<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\SuperAdmin\Add_School;
use App\School\Teacher;
use Auth;
use App\CommonModels\Role;
use Cache;
use Str;

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
        $schools = null;
        if(Auth::user()->role_id == Role::where('name','SuperAdmin')->first()->id ){
                $schools = Add_School::count();
        }

        if(Auth::user()->role_id == Role::where('name','School')->first()->id  || Auth::user()->role_id == Role::where('name','SuperAdmin')->first()->id){
            $teacher = Teacher::count();
        }
        return view('home',compact('schools','teacher'));
    }

    public function logout()
    {
        Cache::forget('school');
        return redirect('login');
    }
}
