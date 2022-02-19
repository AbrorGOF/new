<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseReferences extends Model
{
    use HasFactory;
    protected $table = 'nurse_references';
    protected $fillable = [
      'nurse_id',
      'user_id',
      'file',
      'status'
    ];
}
