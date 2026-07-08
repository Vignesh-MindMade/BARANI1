<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurPrograms extends Model
{
    use HasFactory;

    protected $table = 'our_programs';
    protected $fillable = ['program'];
    
     

}
