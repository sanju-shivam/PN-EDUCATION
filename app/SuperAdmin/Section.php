<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = "section";

    protected $fillable = ['name'];

    public function class_schedule(){
    	return $this->belongsTo('App\School\ClassSchedule');
    }
}
