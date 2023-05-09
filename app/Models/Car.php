<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    protected $fillable = [
        'make',
        'model',
        'year',
        'price',
        'body_type',
        'transmission',
        'doors',
        'engine_type',
        'engine_power',
        'torque',
        'acceleration',
        'top_speed',
        'description',
        'main_image',
        'additional_images',
    ];
}
