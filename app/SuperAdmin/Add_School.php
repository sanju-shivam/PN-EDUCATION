<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class Add_School extends Model
{
    protected $table = "add_school";

    protected $fillable = [
    	'name',
    	'logo',
    	'address',
    	'city',
    	'state',
    	'pin_code',
    	'phone_no',
    	'email',
    	'affilation_no',
    	'board_name',
    ];
}
