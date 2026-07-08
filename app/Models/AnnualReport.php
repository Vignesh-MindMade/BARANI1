<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualReport extends Model
{
    use HasFactory;

    protected $table = 'annual-report';
    protected $fillable = ['title','annual_report_id','year','subtitle','text_1','pdf_1','text_2','pdf_2','text_3','pdf_2'];
    
    // Define the relationship
    public function title()
    {
        return $this->belongsTo(AnnualReportTitle::class, 'annual_report_id');
    }

}
