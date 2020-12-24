<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = "add_teacher";

    protected $fillable =[
    	'name',
    	'phone_no',
    	'address',
    	'city',
    	'state',
    	'pincode',
    	'institute_id',
    	'email',
    	'image',
    	'id_proof',
    	'password',
    	'status',
    ];
}
