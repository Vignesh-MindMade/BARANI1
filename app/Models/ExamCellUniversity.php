<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCellUniversity extends Model
{
    use HasFactory;
    
    protected $table = 'examcell_university';
    protected $fillable = ['title','date','date2','pdf','pdf2'];
}
