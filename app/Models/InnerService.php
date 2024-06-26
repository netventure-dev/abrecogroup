<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InnerService extends Model
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
    public function subservices()
    {
        return $this->hasOne('App\Models\SubService','uuid','sub_service_id');
    }
    public function contents()
    {
        return $this->hasMany('App\Models\InnerServiceContent', 'inner_service_id', 'uuid');
    }
    public function casestudy()
    {
        return $this->hasMany('App\Models\CaseStudy','inner_service_id','uuid');
    }
}
