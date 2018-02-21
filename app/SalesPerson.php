<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SalesPerson extends BaseModel
{
    protected $table = 'sales_people';
    protected $dates = ['deleted_at'];
    public static $rules = [
    	'did' => 'required|unique_with:sales_people,sales_person',
    	'sales_person' => 'required',
    ];
}
