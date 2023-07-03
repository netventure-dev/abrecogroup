<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    use HasFactory;
    public static function firstOrCreate()
    {
        $obj = static::first();
        return $obj ?: new static;
    }
}
