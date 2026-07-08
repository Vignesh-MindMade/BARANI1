<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCellPeopleTitle extends Model
{
    use HasFactory;

    protected $table = 'examcell_people_titles';
    protected $fillable = ['title'];

    
}
