<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $fillable = [
        'established',
        'manufacturing_units',
        'employees',
        'global_reach',
    ];

    protected $table = 'faqs';
}