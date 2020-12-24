<?php

namespace App\Http\Middleware\School;
use App\CommonModels\Role;
use Auth;
use Closure;

class OnlySchool
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role_id != Role::where('name', 'School')->first()->id){
            return redirect('/home')->with('warning', 'You Are Not Allowed For That Access');
        }
        return $next($request);
    }
}
