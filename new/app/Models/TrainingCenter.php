<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCenter extends Model
{
    use HasFactory;
    protected $table = 'training_center';
    protected $fillable =
        [
            'title',
            'address',
            'phone',
            'director',
            'photo'
        ];
}
