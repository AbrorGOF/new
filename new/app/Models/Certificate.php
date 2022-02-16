<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $table = 'nurse_certificates';
    protected $fillable =
        [
            'nurse_id',
            'training_center_id',
            'number',
            'date',
            'end_date',
            'file'
        ];
}
