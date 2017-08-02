<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rule extends BaseModel
{
    protected $table = 'rules';
	public static $rules = [
		'rule_name' => 'required|max:50|string',
        'salesforce_product_code' => 'required|max:50|string',
        'submitted_name_1' => 'required|string',
        'input_1' => 'required|string',
        'output' => 'required|string'
	];  

	public function user() 
	{
		return $this->belongsTo(User::class, 'created_by', 'id');
	}

}
