<?php

namespace App\Http\Traits;
use Cache;
use App\SuperAdmin\Add_School;
use App\CommonModels\Role;

trait SuperAdminCacheTrait {
    public function index() {
    	$user_id 	=	Auth::user()->role_id;
    	if(
    		$user_id == Role::where('name','School')->first()->id || 
			$user_id == Role::where('name','Teacher')->first()->id ||
			$user_id == Role::where('name','Student')->first()->id
    	){
    		Cache::forever('school', function(){
        		return Add_School::select('id','name')->find(Auth::user()->user_type_id)->first();
        	});

        	Cache::forever('school_name_slug',Str::slug(Cache::get('school')->name));
        }
    }
}