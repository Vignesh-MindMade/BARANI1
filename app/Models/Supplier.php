<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;


  protected $fillable = [
        'banner_image',
        'description',
        'image',
        'hydraulic_press_manufacturing',
        'custom_automation_solutions',
    ];

    protected $table='supplier_space';
    
}
