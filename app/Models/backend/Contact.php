<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table ="contact";
    protected $fillable = [
    'banner_image', 'contact_title', 'contact_description',
];

}
