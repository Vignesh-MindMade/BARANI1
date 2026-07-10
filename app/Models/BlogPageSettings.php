<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPageSettings extends Model
{
    use HasFactory;
    protected $table = 'blog_page_settings';
    protected $fillable = [
        'banner_image',
        'banner_title',
        'section_subtitle',
        'section_title',
        'section_description'

    ];
}
