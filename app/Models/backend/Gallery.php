<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table ="gallery";

    protected $fillable = [
        'banner_image', 'image', 'description'
    ];

}
