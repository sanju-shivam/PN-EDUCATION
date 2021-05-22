<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ClassSchedule extends Model
{
	use SoftDeletes;
	
    protected $table = "class_schedule";

    protected $fillable =[
    	'class_id',
        'institute_id',
    	'section_id',
    	'subject_id',
    	'teacher_id',
    	'day_id',
    	'time_id',
    	'status',
    ];

    public function Class()
    {
        return $this->hasMany('App\SuperAdmin\ClassModel','id','class_id');
    }
    public function subject(){
        return $this->hasMany('App\SuperAdmin\subject', 'id', 'subject_id');
    }

    public function section(){
        return $this->hasMany('App\SuperAdmin\section', 'id', 'section_id');
    }

    public function teacher(){
        return $this->hasMany('App\School\Teacher', 'id', 'teacher_id');
    }
    
    public function day(){
        return $this->hasMany('App\SuperAdmin\Day', 'id', 'day_id');
    }
    public function time(){
        return $this->hasMany('App\SuperAdmin\Time', 'id', 'time_id');
    }

}
