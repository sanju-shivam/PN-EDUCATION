<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;

class Is_Class_teacher extends Model
{
    protected $table = "is_class_teacher";

    protected $fillable = [
    	'class_id',
    	'teacher_id',
    	'institute_id'
    ];

    public function Class()
    {
    	return $this->hasMany('App\SuperAdmin\ClassModel','id','class_id');
    }

    public function Teacher()
    {
    	return $this->hasMany(Teacher::class,'id','teacher_id');
    }
}
