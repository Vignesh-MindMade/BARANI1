<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topbar extends Model
{
    use HasFactory;

    protected $table = 'topbars';
    protected $fillable = [
        'updated_on',
        'title',
        'catagory',
        'description',
        'pdf',
        'minimum_age_rules_points',
        'sort_id'
    ];

}
