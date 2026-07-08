<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapabilitiesSubmenuPages extends Model
{
    use HasFactory;
    protected $table = 'capabilities_submenu_pages';
    public $timestamps = false;

    protected $fillable = [
        'menu_id',
        'slug',
        'template', // 'template_1' or 'template_2'

        // Shared Fields
        'banner_title',
        'banner_image',
        'intro_title',
        'intro_description',

        // Template 1 Fields (Capabilities)
        'parallax_image',
        'services_subtitle',
        'press_sections', // Array of sections: [{ title, items: [{ title, description }] }]
        'main_features',
        'bottom_section_items',

        // Template 2 Fields (Tooling & Automation)
        'feature_list', // List with images (Tooling types, Automation items)
        'feature_rows', // Alternating rows (End-to-end, Value Eng, Die Protection, etc.)
        'process_title',
        'process_steps', // Tooling Process
        'strength_materials_title', // "Materials" or "Our Strength"
        'strength_materials_grid',
    ];

    protected $casts = [
        // Template 1
        'press_sections' => 'array',
        'main_features' => 'array',
        'bottom_section_items' => 'array',

        // Template 2
        'feature_list' => 'array',
        'feature_rows' => 'array',
        'process_steps' => 'array',
        'strength_materials_grid' => 'array',
    ];

    public function menu()
    {
        return $this->belongsTo(CapabilitiesMenu::class, 'menu_id');
    }
}