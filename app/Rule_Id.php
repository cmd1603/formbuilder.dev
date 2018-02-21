<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rule_Id extends BaseModel
{
    protected $table = 'rule_ids';
    public static $rules = [
    	'rule_name' => 'required|string'
    ];

	public function user() 
	{
		return $this->belongsTo(User::class, 'created_by', 'id');
	}    
}
