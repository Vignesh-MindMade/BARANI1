<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocurricularDetail extends Model
{
    use HasFactory;
    
    protected $table = 'cocurricular_detail';
    protected $fillable = ['description'];

}
