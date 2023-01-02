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
        return $this->hasMany('App\Models\ServiceFaq','id','service_id');
    }
    public function contents()
    {
        return $this->hasMany('App\Models\ServiceContent','id','service_id');
    }
}
