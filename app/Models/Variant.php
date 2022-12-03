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
        return $this->hasOne('App\Models\Brand');
    }

    public function sub_model_id()
    {
        return $this->hasOne('App\Models\SaleDifficulty');
    }

}