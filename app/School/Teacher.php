<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;
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
