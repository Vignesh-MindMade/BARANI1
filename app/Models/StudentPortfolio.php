<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPortfolio extends Model
{
    use HasFactory;

    protected $table = 'students_portfolio';

    protected $fillable = [
        'student_name',
        'project_name',
        'description',
        'thumbnail',
        'thumbnail2',
        'filter_id',
        'images', // JSON column for dynamic images
        'contents', // JSON column for dynamic contents
    ];

    protected $casts = [
        'images' => 'array',
        'contents' => 'array',
    ];
}