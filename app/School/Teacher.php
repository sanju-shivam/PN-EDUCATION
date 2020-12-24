<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
<<<<<<< HEAD
=======
    use SoftDeletes;

>>>>>>> a950e1a181ffe77825a0409f224b097436cab340
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
