<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Service extends Model
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
    public function faqs()
    {
        return $this->hasMany('App\Models\ServiceFaq','service_id','uuid');
    }
    public function contents()
    {
        return $this->hasMany('App\Models\ServiceContent','service_id','uuid');
    }
    public function subservices()
    {
        return $this->hasMany('App\Models\SubService','service_id','uuid');
    }
    public function casestudy()
    {
        return $this->hasMany('App\Models\CaseStudy','service_id','uuid');
    }
}
