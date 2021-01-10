<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = "time";

    protected $fillable = ['time'];
}
