<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = "day";

    protected $fillable =['name'];
}
