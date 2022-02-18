<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;
    protected $table = 'nurses';
    protected $fillable =
        [
            'user_id',
            'name',
            'surname',
            'patronymic',
            'region_id',
            'category_id',
            'passport',
            'pinfl',
            'central_polyclinic',
            'family_polyclinic',
            'doctor_station',
            'reference',
            'status'
        ];
    public function phone(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select(['phone', 'id']);
    }
}
