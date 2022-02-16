<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplom extends Model
{
    use HasFactory;
    protected $table = 'nurse_diplomas';
    protected $fillable =
        [
            'nurse_id',
            'college_id',
            'number',
            'date',
            'degree',
            'file'
        ];
}
