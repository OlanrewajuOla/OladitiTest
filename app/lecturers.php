<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecturers extends Model
{
    protected $fillable = [
		'fullname',
		'Email',
		'department',
		'gender',
		'dateofbirth',
		'Address',
		'Qualification',
		'Experience',
		'cader',
		'Expectedworkload',
		'AreaofInterest'
	];
}
