<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurricularMain extends Model
{
    use HasFactory;

    protected $table = 'circulars_main';

    protected $fillable = [
        'title',
        'span_title',
        'catagory_image',
        'sort_id',
    ];
}
