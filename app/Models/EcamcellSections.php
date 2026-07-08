<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcamcellSections extends Model
{
    use HasFactory;
    protected $table = 'examcell_sections';
    protected $fillable = ['exam_name'];
}

