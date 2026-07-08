<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaraniGroupSubmenuPageSectionItem extends Model
{
    protected $table = 'baranigroup_submenu_page_section_items';

    protected $fillable = [
        'section_id',
        'image_title',
        'image',
    ];

    public function section()
    {
        return $this->belongsTo(BaraniGroupSubmenuPageSection::class, 'section_id');
    }
}