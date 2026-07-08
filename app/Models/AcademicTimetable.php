<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AcademicTimetable extends Model
{
    use HasFactory;

    protected $table = 'academic_timetable';
    protected $fillable = [
        'year_from',
        'year_to',
        'year_1_odd_pdf',
        'year_1_even_pdf',
        'year_2_odd_pdf',
        'year_2_even_pdf',
        'year_3_odd_pdf',
        'year_3_even_pdf',
        'year_4_odd_pdf',
        'year_4_even_pdf',
        'year_5_odd_pdf',
        'year_5_even_pdf',
        ];
    
    

}
