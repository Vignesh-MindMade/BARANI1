<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitingfaculty extends Model
{
    use HasFactory;

    protected $table = 'visiting_faculty';
    protected $fillable = ['name', 'designation','image'];


}