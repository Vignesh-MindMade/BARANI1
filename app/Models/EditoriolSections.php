<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditoriolSections extends Model
{
    use HasFactory;
    protected $table = 'homepage_aboutus';
    protected $fillable = ['title','description','image'];  
}

