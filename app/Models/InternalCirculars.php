<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalCirculars extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = [
        'Year',
        'title',
        'semester_1', 'sem1_internal_1', 'sem1_internal_pdf_1', 'sem1_internal_2', 'sem1_internal_pdf_2', 'sem1_internal_3', 'sem1_internal_pdf_3',
        'semester_2', 'sem2_internal_1', 'sem2_internal_pdf_1', 'sem2_internal_2', 'sem2_internal_pdf_2', 'sem2_internal_3', 'sem2_internal_pdf_3',
        'semester_3', 'sem3_internal_1', 'sem3_internal_pdf_1', 'sem3_internal_2', 'sem3_internal_pdf_2', 'sem3_internal_3', 'sem3_internal_pdf_3',
        'semester_4', 'sem4_internal_1', 'sem4_internal_pdf_1', 'sem4_internal_2', 'sem4_internal_pdf_2', 'sem4_internal_3', 'sem4_internal_pdf_3',
        'semester_5', 'sem5_internal_1', 'sem5_internal_pdf_1', 'sem5_internal_2', 'sem5_internal_pdf_2', 'sem5_internal_3', 'sem5_internal_pdf_3',
        'semester_6', 'sem6_internal_1', 'sem6_internal_pdf_1', 'sem6_internal_2', 'sem6_internal_pdf_2', 'sem6_internal_3', 'sem6_internal_pdf_3',
        'semester_7', 'sem7_internal_1', 'sem7_internal_pdf_1', 'sem7_internal_2', 'sem7_internal_pdf_2', 'sem7_internal_3', 'sem7_internal_pdf_3',
        'semester_8', 'sem8_internal_1', 'sem8_internal_pdf_1', 'sem8_internal_2', 'sem8_internal_pdf_2', 'sem8_internal_3', 'sem8_internal_pdf_3',
        'semester_9', 'sem9_internal_1', 'sem9_internal_pdf_1', 'sem9_internal_2', 'sem9_internal_pdf_2', 'sem9_internal_3', 'sem9_internal_pdf_3',
        'semester_10', 'sem10_internal_1', 'sem10_internal_pdf_1', 'sem10_internal_2', 'sem10_internal_pdf_2', 'sem10_internal_3', 'sem10_internal_pdf_3',
    ];
    


}
