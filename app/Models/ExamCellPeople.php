<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCellPeople extends Model
{
    use HasFactory;

    protected $table = 'examcell_people';
    protected $fillable = ['title','name','designation'];
}
