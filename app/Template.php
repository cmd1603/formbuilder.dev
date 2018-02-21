<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends BaseModel 
{
	use SoftDeletes;
	protected $table = 'templates';
	protected $dates = ['deleted_at'];
	public static $rules = [
		'directory_label' => 'required|max:100|string',
        'salesforce_product_code' => 'required|string',
        'configuration' => 'required|string',
        'workarea_html' => 'required|string',
        'cutting_technology' => 'required|in:router,fabrication,digital_finishing'
	];


	public function user() 
	{
		return $this->belongsTo(User::class, 'created_by', 'id');
	}

}