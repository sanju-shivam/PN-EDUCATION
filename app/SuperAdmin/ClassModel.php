<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
	use SoftDeletes;

    protected $table = "class";

    protected $fillable = ['name'];


    public function Class_Subject_Teacher()
    {
    	return $this->belongsTo('App\School\Class_Subject_Teacher');
    }
}
