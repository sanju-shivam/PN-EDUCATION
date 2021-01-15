<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;

class Class_Student extends Model
{
    protected $fillable =[
    	'institute_id',
    	'class_id',
    	'student_id'
    ];

    public function Student()
    {
    	$a =  $this->belongsTo(Student::class,'class_id','id');
    	return "SNJU";
    }
}
