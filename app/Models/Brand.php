<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model 
{

    protected $table = 'brands';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function sale_difficulty()
    {
        return $this->belongsTo('App\Models\SaleDifficulty','difficulty_id','id');
    }

}