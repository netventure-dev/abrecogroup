<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubModel extends Model 
{

    protected $table = 'sub_models';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function sale_difficulty()
    {
        return $this->belongsTo('App\Models\SaleDifficulty','difficulty_id','id');
    }

    public function brand_data()
    {
        return $this->hasOne('App\Models\Brand','id','brand_id');
    }

}