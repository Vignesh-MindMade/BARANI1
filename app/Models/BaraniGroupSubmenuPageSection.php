<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BaraniGroupSubmenuPageSection extends Model
{
    protected $table = 'baranigroup_submenu_page_section';

    protected $fillable = [
        'page_id',
        'press_construction_title',
        'press_construction_points',
        'press_construction_imagetitle',
        'press_construction_image',
    ];

    public function page()
    {
        return $this->belongsTo(BaraniGroupSubmenuPage::class, 'page_id');
    }
      public function items()
    {
        return $this->hasMany(BaraniGroupSubmenuPageSectionItem::class, 'section_id');
    }
}