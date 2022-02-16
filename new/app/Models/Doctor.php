<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable =
        [
            'user_id',
            'name',
            'surname',
            'patronymic',
            'region_id',
            'polyclinic_id',
            'position',
            'passport',
            'pinfl',
            'status'
        ];
}
