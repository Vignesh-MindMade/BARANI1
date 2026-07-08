<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table ="job_applications";
    protected $fillable = [
        'unit',
    'full_name',
    'email',
    'phone',
    'location',
    'position',
    'experience_years',
    'expected_salary',
    'available_from',
    'qualification',
    'specialization',
    'resume_path',
    'additional_docs_path',
    ];
}
