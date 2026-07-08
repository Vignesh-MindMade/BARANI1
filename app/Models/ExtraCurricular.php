<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraCurricular extends Model
{
    use HasFactory;

    protected $table = 'extra_circulars';
    protected $fillable = ['title','image', 'description'];
}
