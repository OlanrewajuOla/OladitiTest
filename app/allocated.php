<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class allocated extends Model
{
    protected $fillable = [
    	'courses_id',
    	'lecturers_name',
    	'department',
    	'unit'
    ];
}
