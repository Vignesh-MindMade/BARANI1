<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archigazette extends Model
{
    use HasFactory;
    protected $table = 'archigazette';
    protected $fillable = ['posted_by','title','posted_on','image','pdf'];
    
    
   
}

