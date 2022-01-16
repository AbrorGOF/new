<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportJournal extends Model
{
    use HasFactory;
    protected $table = 'report_journals';
    protected $fillable = [
        'patient_full_name',
        'patient_age',
        'patient_visit_time',
        'patient_address',
        'doctor_full_name',
        'doctor_diagnosis',
        'treatment_name',
        'category_id',
        'others',
        'user_id'
    ];
    protected $appends = [
        'category'
    ];
    public function getCategoryAttribute(): string
    {
        $cat = DB::table('report_categories')->where('id', '=', $this->original['category_id'])->first();
        return $this->attributes['category'] = $cat->title;
    }
}
