<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
     protected $table = "class";

    protected $fillable = ['name','institute_id'];
}
