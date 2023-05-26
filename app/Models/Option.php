<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'category', 'name', 'price'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
