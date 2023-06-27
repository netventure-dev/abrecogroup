<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InnerServiceContent extends Model
{
    use HasFactory;
    use Sluggable;

public function sluggable(): array
{
    return [
        'slug' => [
            'source' => 'services'
        ]
    ];
}

public function extra_contents()
    {
        return $this->hasMany('App\Models\InnerServiceExtra','inner_service_content_id','uuid');
    }
}
