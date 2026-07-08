<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SustainabilityGovernance extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'description',
    'points',
];

    protected $table = 'sustainabilities_governance';
}
