<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaraniGroupSubmenuPageManufacturingFacility extends Model
{
    use HasFactory;
    protected $table='baranigroup_submenu_page_manufacturing_facility';

    protected $fillable= [
        'page_id',
        'facility_title',
        'facility_bg_video',
        'facility_testimonial',
        'card1_title',
        'card1_points',
        'card2_title',
        'card2_points',
        'card3_title',
        'card3_points',
        'card4_title',
        'card4_points',

    ];
}
