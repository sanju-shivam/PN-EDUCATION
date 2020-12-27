<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
	use SoftDeletes;
	
    protected $table = 'subject';

    protected $fillable = ['name'];
}
