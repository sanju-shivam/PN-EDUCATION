<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;
use App\School\TimeTable;
use Auth;

class Time extends Model
{
    protected $table = "time";

    protected $fillable = ['start_time','end_time','institute_id'];

    public function class_schedule(){
    	return $this->belongsTo('App\School\ClassSchedule');
    }
}
