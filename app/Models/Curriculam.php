<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculam extends Model
{

use HasFactory;

protected $fillable = [
    'banner',
    'cbse_curriculum_standards',
    'minimum_age_rules_paragraph',
    'minimum_age_rules_points',
];

    protected $table = 'cbse_curriculams';
}

