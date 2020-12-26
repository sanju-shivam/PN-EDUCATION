<?php

namespace App\School;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = ['subject'];

    protected $fillable = ['name','institute_id'];
}
