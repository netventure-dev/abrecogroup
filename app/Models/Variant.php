<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model 
{

    protected $table = 'variants';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function brand_data()
    {
        return $this->belongsTo('App\Models\Brand','brand_id','id');
    }

    public function sub_model_data()
    {
        return $this->belongsTo('App\Models\SubModel','sub_model_id','id');
    }
    public function fuel_type()
    {
        return $this->belongsTo('App\Models\FuelType','fuel_id','id');
    }

}