<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCategories extends Model
{
    use HasFactory;
    protected $table = 'report_categories';
    protected $fillable = [
        'title',
        'type',
    ];

    public function quarterlies(){
        return $this->hasOne(ReportQuarterly::class,'category_id','id');
    }
}
