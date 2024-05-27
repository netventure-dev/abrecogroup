<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestRateContent extends Model
{
    use HasFactory;

    public function service_data()
    {
        return $this->hasOne('App\Models\ServiceCare','id','service_care_id');
    }
}
