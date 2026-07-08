<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraCurricularDetail extends Model
{
    use HasFactory;


    protected $table = 'extra_curricullar_detail';
    protected $fillable = ['extra_curricullar_id', 'image', 'description'];
    
    protected $casts = [
    'extra_curricular_id' => 'integer', // Automatically cast extra_curricular_id to integer
];
}
