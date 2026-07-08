<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'view_awards';
    protected $fillable = ['title', 'view_awards_description', 'sort_id', 'award_image','images'];

    protected $casts = [
        'images' => 'array',
    ];
}