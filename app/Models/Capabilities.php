<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capabilities extends Model
{
    use HasFactory;
    protected $fillable= [
        'capabilities_title',
        'capabilities_desc',
        'capabilities_workflow_section1_title',
        'capabilities_workflow_section1_desc',
        'capabilities_workflow_section1_image',
        'capabilities_workflow_section2_title',
        'capabilities_workflow_section2_desc',
        'capabilities_workflow_section2_image',
        'capabilities_workflow_section3_title',
        'capabilities_workflow_section3_desc',
        'capabilities_workflow_section3_image',
        'capabilities_workflow_engineering_strength_title',
        'capabilities_workflow_engineering_strength_desc',
        'capabilities_workflow_engineering_strength_points',
        'capabilities_parallax_image',
        'capabilities_quality_environmental_systems_title',
        'capabilities_quality_environmental_systems_desc',
        'capabilities_quality_environmental_systems_left_image',
        'capabilities_quality_environmental_systems_right_image',


    ];
    protected $table='capabilities';
}
