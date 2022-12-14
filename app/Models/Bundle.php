<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;
    public function size_data()
    {
        return $this->belongsTo('App\Models\Size','size_id','id');
    }
}
