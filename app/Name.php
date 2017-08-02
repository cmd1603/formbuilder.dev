<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Name extends BaseModel
{
    protected $table = 'names';
	public static $names = [
		'submitted_name' => 'required|max:40|string',
        'part_name' => 'required|max:50|string',
        'configuration' => 'required|string',
	];  

	public function user() 
	{
		return $this->belongsTo(User::class, 'created_by', 'id');
	}

}