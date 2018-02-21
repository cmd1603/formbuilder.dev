<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'product_access';
    public static $rules = 
    [
    	'did' => 'required|not_in:0',
    	'code' => 'required|not_in:0'
    ];
}
