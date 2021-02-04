<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
	use SoftDeletes;
	
    protected $table = 'subject';

    protected $fillable = ['name'];

    public function Class_Subject_Teacher()
    {
    	return $this->belongsTo('App\School\Class_Subject_Teacher');
    }

    public function class_schedule(){
    	return $this->belongsTo('App\School\ClassSchedule');
    }

    public function Time_Table(){
        return $this->belongsTo('App\School\TimeTable');
    }
}
