<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $table = 'workers';
    protected $fillable =
        [
            'user_id',
            'name',
            'surname',
            'patronymic',
            'region_id',
            'training_center_id',
            'position',
            'passport',
            'pinfl',
            'status'
        ];
}
