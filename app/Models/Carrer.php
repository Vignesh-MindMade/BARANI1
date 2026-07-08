<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrer extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'categories',
        'location',
        'description',
        'posted_at',
        'minimum_age_rules_points',
        'banner_image',
    ];
    protected $table = 'carriers';
}
