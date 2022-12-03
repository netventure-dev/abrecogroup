<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model 
{

    protected $table = 'owners';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function sale_difficulty()
    {
        return $this->hasOne('App\Models\SaleDifficulty');
    }

}