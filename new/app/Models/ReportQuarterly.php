<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportQuarterly extends Model
{
    use HasFactory;

    protected $table = 'report_quarterlies';
    protected $fillable = [
        'user_id',
        'category_id',
        'year',
        'first',
        'second',
        'third',
        'fourth'
    ];
}
