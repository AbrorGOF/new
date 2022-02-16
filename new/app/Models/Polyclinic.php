<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polyclinic extends Model
{
    use HasFactory;
    protected $table = 'polyclinics';
    protected $fillable =
        [
            'phone',
            'title',
            'address',
            'region_id',
            'city_id'
        ];
}
