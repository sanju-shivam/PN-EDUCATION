<?php

namespace App\Http\Middleware\SuperAdmin;

use Closure;
use App\CommonModels\Role;
use Auth;
use Cache;

class OnlySuperAdmin
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
        if(Auth::user()->role_id != Role::where('name', 'SuperAdmin')->first()->id){
            return redirect('/home')->with('warning','You Are Not Allowed For That Access');
        }
        return $next($request);
    }
}
