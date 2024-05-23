<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ImpactSetting extends Model
{
    use HasFactory;
    public $incrementing = false;
    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
}
