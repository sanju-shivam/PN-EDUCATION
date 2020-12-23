<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Add_School extends Model
{
    use SoftDeletes;

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
        'password',
    	'affilation_no',
    	'board_name',
        'role_id',
        'status'
    ];
}
