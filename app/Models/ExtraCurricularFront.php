<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraCurricularFront extends Model
{
    use HasFactory;

    protected $table = 'extra_curricullar_front';
    protected $fillable = ['title','catagory_name','catagory_image'];
    
    protected $casts = [
    'extra_curricular_id' => 'integer', // Automatically cast extra_curricular_id to integer
];

}
