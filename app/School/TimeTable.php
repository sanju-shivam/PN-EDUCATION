<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
      protected $table = '_time_table_school';
   	protected $fillable =[
   		'class_id',
   		'day_id',
   		'teacher_id',
   		'subject_id',
   		'institute_id',
   		'section_id',
   		'time_slot_id',
   	];


      public function Teacher()
      {
         return $this->hasMany(Teacher::class,'id','teacher_id');
      }

      public function Subject()
      {
         return $this->hasMany('App\SuperAdmin\Subject','id','subject_id');
      }

      public function Time_Slot()
      {
         return $this->belongsTo('App\SuperAdmin\Time');
      }
}
