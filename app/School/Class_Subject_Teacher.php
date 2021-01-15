<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;

class Class_Subject_Teacher extends Model
{
	protected $table = 'class_with_subject_with_teacher';
    protected $fillable = [
    	'class_id',
    	'subject_id',
    	'teacher_id',
    	'institute_id',
    ];

    public function Class()
    {
    	return $this->hasMany('App\SuperAdmin\ClassModel','id','class_id');
    }

    public function Teacher()
    {
    	return $this->hasMany(Teacher::class,'id','teacher_id');
    }

    public function Subject()
    {
    	return $this->hasMany('App\SuperAdmin\Subject','id','subject_id');
    }
}
