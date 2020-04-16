<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lectures extends Model
{
	protected $fillabe = [
		'fullname',
		'Email',
		'department',
		'gender',
		'dateofbirth',
		'Address',
		'Qualification',
		'Experience'
	];
	}
