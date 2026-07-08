<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaraniGroupSubmenuPagePressStandards extends Model
{
    use HasFactory;
     protected $table='baranigroup_submenu_page_press_standards';

    protected $fillable= [
        'page_id',
        'press_main_title',
        'press_detail_logo',
        'press_detail_title',
        'press_detail_desc'
        
    ];
    public function page()
    {
        return $this->belongsTo(BaraniGroupSubmenuPage::class, 'page_id');
    }
}
