<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgeingRV extends Model 
{

    protected $table = 'ageing_rv';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function variant_id()
    {
        return $this->hasOne('App\Models\Variant');
    }

}