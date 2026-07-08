<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaraniGroupSubmenuPageDesignStrength extends Model
{
    use HasFactory;
         protected $table='baranigroup_submenu_page_design_strength';

    protected $fillable= [
        'page_id',
        'design_title',
        'design_softwares_logo',
        'design_text'
        
    ];
    public function page()
    {
        return $this->belongsTo(BaraniGroupSubmenuPage::class, 'page_id');
    }
}
