<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaciltiesHeading extends Model
{
    use HasFactory;

    protected $table = 'aboutus_main';

    protected $fillable = [
        'banner_image',
        'aboutus_description',
        'aboutus_image_1',
        'aboutus_image_2',
        'mission_description',
        'vission_description',
        'history_description'
    ];
}
