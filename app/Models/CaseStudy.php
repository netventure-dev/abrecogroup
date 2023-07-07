<?php

namespace App\Models;


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
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

    public function contents()
    {
        return $this->hasMany('App\Models\CaseStudyContent', 'case_id', 'uuid');
    }   

    public function service_name()
    {
        return $this->hasOne('App\Models\Service','uuid','service_id');
    }

    public function sub_service()
    {
        return $this->hasOne('App\Models\SubService','uuid','sub_service_id');
    }
}
