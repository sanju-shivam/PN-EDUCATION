<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    
	protected $table ="students";
    protected $fillable=[
    	'name',
    	'phone_no',
    	'address',
    	'city',
    	'state',
    	'pincode',
    	'institute_id',
    	'email',
    	'image',
    	'gender',
    	'id_proof',
    	'password',
    	'status',
    	'DOB',
    ];

    public function Class()
    {
        return $this->hasMany(Class_Student::class);
    }
}
