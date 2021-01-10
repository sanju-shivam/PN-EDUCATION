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
    	'section_id',
    	'subject_id',
    	'teacher_id',
    	'day_id',
    	'time_id',
    	'status',
    ];
}
