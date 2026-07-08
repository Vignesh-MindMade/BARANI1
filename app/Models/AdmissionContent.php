<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionContent extends Model
{
    use HasFactory;

    protected $table = 'admission_content';
    protected $fillable = ['admission'];
    
     

}
