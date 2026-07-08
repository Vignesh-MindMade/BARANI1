<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedagogy extends Model
{
    use HasFactory;

    protected $table = 'pedagogy';
    protected $fillable = ['prog_name','prog_content','prog_image'];
    
     

}
