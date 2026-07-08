<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsgIaq extends Model
{
    use HasFactory;

    protected $table = 'psgiaq';
    protected $fillable = ['content', 'section'];
    
    
    
     

}
