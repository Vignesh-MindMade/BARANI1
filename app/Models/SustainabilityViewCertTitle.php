<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SustainabilityViewCertTitle extends Model
{
    use HasFactory;
    protected $fillable=[
        'main_title',
        'sub_title',
    ];
    protected $table='sustainabilities_viewcerttitle';
}
