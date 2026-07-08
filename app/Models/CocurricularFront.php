<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocurricularFront extends Model
{
    use HasFactory;
    
    protected $table = 'cocurricular_front';
     protected $fillable = ['title', 'heading', 'date', 'location', 'image', 'order_id'];
    
}
