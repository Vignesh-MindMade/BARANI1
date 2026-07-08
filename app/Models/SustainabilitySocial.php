<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SustainabilitySocial extends Model
{
    use HasFactory;
     protected $fillable = [
    'main_title',
    'title',
    'description',
    'image',
    'sort_id',
];

    protected $table = 'sustainabilities_social';
}
