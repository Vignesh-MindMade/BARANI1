<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionSections extends Model
{
    use HasFactory;
    protected $table = 'admission_sections';
    protected $fillable = ['name'];
}

