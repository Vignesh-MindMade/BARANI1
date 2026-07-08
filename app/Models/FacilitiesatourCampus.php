<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitiesatourCampus extends Model
{
    use HasFactory;

    protected $table = 'facilitiesatourcampus';
    protected $fillable = [
        'banner',
        'facilities_at_our_campus_paragraph',
        'events1_title',
        'events1_text',
        'events1_image',
        'events2_title',
        'events2_text',
        'events2_image',
        'events3_title',
        'events3_text',
        'events3_image',
        'events4_title',
        'events4_text', 
        'events4_image',
        'events5_title',
        'events5_text',
        'events5_image',
        'events6_title',
        'events6_text',
        'events6_image',     
    ];
}
