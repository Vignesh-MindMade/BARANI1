<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JSR extends Model
{
    protected $table = 'jsrs';

protected $fillable = [
        'menu_name',
        'banner',
        'banner_text',
        'about_college_description',
        'about_college_link',
        'count',
        'jsrec_description',
        'dark_text',
        'light_text',
        'our_specialize_title',
        'our_specialize_subtitle',
        'testimoniol',
        'testimoniol_bg_image',
        'our_highlights',
        'our_highlights_subtitle',
        'our_highlights_items',
        'program_categories',
    ];


    protected $casts = [
        'banner' => 'array',
        'dark_text' => 'array',
        'light_text' => 'array',
        'testimoniol' => 'array',
        'our_highlights_items' => 'array',
        'program_categories' => 'array',
        'count' => 'integer',
    ];
}
