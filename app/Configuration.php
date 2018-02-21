<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends BaseModel 
{
	use SoftDeletes;
	protected $table = 'configurations';
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

	public function setDirectory_LabelAttribute($value)
	{
		$this->attributes['directory_label'] = htmlspecialchars(strip_tags($value));
	}

	public function setConfigurationAttribute($value)
	{
		$this->attributes['configuration'] = htmlspecialchars(strip_tags($value));
	}

	public function getDirectory_LabelAttribute($value)
	{
		return ucwords($value);
	}

	public static function count($userId)
    {
        return Configuration::where('created_by', '=', $userId)->count();
    }

    public static function search($search = null)
    {
    	if ($search != null) {
    		return Configuration::where('directory_label', 'LIKE', '%' . $search . '%')->orWhere('configuration', 'LIKE', '%' . $search . '%')->paginate(10);
    	}
    }

    public static function newestConfigurations()
    {
    	return Configuration::where('created_at', '=', Carbon::today())->paginate(10);
    }

}