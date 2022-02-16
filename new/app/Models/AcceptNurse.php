<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptNurse extends Model
{
    use HasFactory;
    protected $table = 'accept_nurse_log';
    protected $fillable =
        [
            'accepted_user_id',
            'nurse_id'
        ];
}
