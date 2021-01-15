<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SuperAdmin\Add_School;

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

    public function school()
    {
        return $this->belongsTo('App\SuperAdmin\Add_School','institute_id');
    }

    public function Class_Subject_Teacher()
    {
        return $this->belongsTo('App\School\Class_Subject_Teacher');
    }
}
