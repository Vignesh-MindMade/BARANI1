<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCellContactUs extends Model
{
    use HasFactory;

    protected $table = 'examcell_contactus';
    protected $fillable = ['title','sub_title','landmark','city','district','state','email','phonenumber'];

}
