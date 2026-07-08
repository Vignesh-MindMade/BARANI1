<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCellAbout extends Model
{
    use HasFactory;

    protected $table = 'examcell_about';
    protected $fillable = ['title','point_1','point_2','point_3','point_4,','point_5','point_6','point_7','point_8','point_9','point_10'];

    protected $casts = [
        'points' => 'array',
    ];

}
