<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaraniGroupSubmenuPage extends Model
{
    use HasFactory;

    protected $table='baranigroup_submenu_page';

    protected $fillable = [
        'submenu_id',
        'template',
        'banner_title',
        'brochure',
        'banner_image',
        'division_title',
        'division_desc',
        'chooseus_points',
        'chooseus_video',
        'view_process_title',
        'view_process_card1_icon',
        'view_process_card1_title',
        'view_process_card1_desc',
        'view_process_card2_icon',
        'view_process_card2_title',
        'view_process_card2_desc',
        'view_process_card3_icon',
        'view_process_card3_title',
        'view_process_card3_desc',
        'view_process_card4_icon',
        'view_process_card4_title',
        'view_process_card4_desc'
        
    ];

    public function submenu()
    {
        return $this->belongsTo(BaraniGroupSubmenu::class, 'submenu_id');
    }
    public function sections()
{
    return $this->hasMany(BaraniGroupSubmenuPageSection::class, 'page_id');
}
public function manufacturingFacility()
{
    return $this->hasOne(BaraniGroupSubmenuPageManufacturingFacility::class, 'page_id');
}
public function pressStandards()
{
    return $this->hasMany(BaraniGroupSubmenuPagePressStandards::class, 'page_id');
}
public function DesignStrength()
{
    return $this->hasMany(BaraniGroupSubmenuPageDesignStrength::class, 'page_id');
}
public function pressedComponent()
{
    return $this->hasOne(Pressed_Component::class, 'page_id');
}

}
