<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlliedFaculty extends Model
{
    use HasFactory;

    protected $table = 'allied_faculty';
    protected $fillable = ['name', 'designation','image','description'];


}