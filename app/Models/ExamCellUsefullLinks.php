<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCellUsefullLinks extends Model
{
    use HasFactory;


    
    protected $table = 'examcell_usefulllinks';
    protected $fillable = ['title','point1','url_1','pdf_1','point_2','url_2','pdf_2','point_3','url_3','pdf_3','point_4,','url_4','pdf_4','point_5','url_5','pdf_5','point_6','url_6','pdf_6','point_7','url_7','pdf_7','point_8','url_8','pdf_8','point_9','url_9','pdf_9','point_10','url_10','pdf_10',];

    protected $casts = [
        'points' => 'array',
    ];
}
 