<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnaUniversity extends Model
{
    use HasFactory;

    
    protected $table = 'anna-nniversity-circulars';
    protected $fillable = ['title', 'year','circular_1','circular_1_pdf','circular_2','circular_3','circular_3_pdf','circular_4_pdf'];
    

}
