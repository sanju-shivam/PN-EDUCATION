<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
	use SoftDeletes;

    protected $table = "class";

    protected $fillable = ['name'];
}
