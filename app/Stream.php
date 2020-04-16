<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = [
    	'department',
    	'level',
    	'total_stream',
    ];
}
