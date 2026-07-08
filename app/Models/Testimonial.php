<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    // Add 'point1' through 'point10' to the $fillable array
    protected $fillable = [
        'title',
        'thumbnailFile',
        'content',
        'file',
        'sort_id',
        'point1',
        'point2',
        'point3',
        'point4',
        'point5',
        'point6',
        'point7',
        'point8',
        'point9',
        'point10',
    ];
}