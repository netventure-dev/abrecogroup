<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceContent extends Model
{
    use HasFactory;

    public function extra_contents()
    {
        return $this->hasMany('App\Models\ServiceExtra','service_content_id','uuid');
    }
}
