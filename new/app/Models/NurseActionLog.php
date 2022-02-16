<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseActionLog extends Model
{
    use HasFactory;
    protected $table = 'nurse_action_log';
    protected $fillable = [
        'user_id',
        'nurse_id',
        'action',
    ];
}
