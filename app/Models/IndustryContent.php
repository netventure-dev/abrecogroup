<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryContent extends Model
{
    use HasFactory;
    
    public function extra_contents()
    {
        return $this->hasMany('App\Models\IndustryExtraContent','industries_content_id','uuid');
    }
}
