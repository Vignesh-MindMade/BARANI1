<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corefaculty extends Model
{
    use HasFactory;

    protected $table = 'core_faculty';
    protected $fillable = ['staff_name', 'designation','staff_image','description'];


}