<?php

namespace App\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class Add_Admin extends Model
{
    protected $table	=	"register_admin";
    protected $fillable	=	[
    	'name',
    	'institute_id',
    	'email',
    	'phone_no',
    	'address',
    	'image',
    	'status'
    ];

}
