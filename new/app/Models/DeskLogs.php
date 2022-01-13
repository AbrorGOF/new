<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskLogs extends Model
{
    use HasFactory;
    protected $table = 'desk_logs';
    protected $fillable = [
        'request',
        'response',
        'status',
        'pinfl',
        'inn',
        'http_code'
    ];
}
