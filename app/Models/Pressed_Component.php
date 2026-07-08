<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Pressed_Component extends Model
{
    use HasFactory;

    protected $table = 'pressed_components';

    protected $fillable = [
        'page_id',
        'banner_image',
        'banner_title',
        'description',
        'capabilities_title',
        'capabilities_subtitle',
        'capabilities_cards',              
        'industries_title',
        'industries_subtitle',
        'industries_icons',
        'industries_name',                
        'manufacturing_capability_title',
        'manufacturing_capability_subtitle',
        'manufacturing_capability_image',
        'manufacturing_capability_description',
        'infrastructure_equipments',
        'core_processes_title',
        'core_processes_subtitle',
        'core_processes_table',            
        'quality_inspection_title',
        'quality_inspection_subtitle',
        'quality_inspection_table',        
        'technology_range_title',
        'technology_range_subtitle',
        'technology_range_cards',  
        'point_section_title',
        'point_title',
        'points',
    ];

    protected $casts = [
        'capabilities_cards'        => 'array',
        'industries_icons'          => 'array',
        'infrastructure_equipments' => 'array',  // Changed from AsArrayObject to array
        'technology_range_cards'    => 'array',
        'industries_name'           => 'array',
        'point_title'               => 'array',
        'points'                    => 'array',
    ];
}