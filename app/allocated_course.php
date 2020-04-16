<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class allocated_course extends Model
{
	protected $fillable = [
		'lecturers_id',
		'course_id',
		'department',
		'level',
		'semester',
		'course_title',
		'course_code',
		'course_unit',
		'stream',
		'externaldepartment',
	];
}
