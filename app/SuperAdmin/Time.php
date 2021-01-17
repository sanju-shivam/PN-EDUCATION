<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = "time";

    protected $fillable = ['time'];

    public function class_schedule(){
    	return $this->belongsTo('App\School\ClassSchedule');
    }
}
