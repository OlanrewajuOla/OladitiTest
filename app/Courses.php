<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    
    protected $fillable = [
    	'department',
    	'level',
    	'semester',
    	'course_title',
    	'course_code',
    	'course_unit',
    	'stream',
    	'externaldepartment'

    ];
}
