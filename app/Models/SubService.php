<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
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

    public function services()
    {
        return $this->hasOne('App\Models\Service','uuid','service_id');
    }
    public function innerservices()
    {
        return $this->hasMany('App\Models\InnerService','sub_service_id','uuid');
    }
    public function contents()
    {
        return $this->hasMany('App\Models\SubServiceContent','sub_service_id','uuid');
    }
}
