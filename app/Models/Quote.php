<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    public function service_doc()
    {
        return $this->hasOne('App\Models\Service','uuid','service');
    }
}
