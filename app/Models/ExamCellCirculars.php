<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCellCirculars extends Model
{
    use HasFactory;

    protected $table = 'examcell_circulars';

    protected $fillable = ['main_titile',
    'sub_title1','sub_title2','sub_title3','sub_title4,',
    'point_header1','point_header2','point_header3','point_header4',
    'point_text1','point_text2','point_text3','point_text4',
    'point_pdf1','point_pdf2','point_pdf3','point_pdf4',

];

}
 