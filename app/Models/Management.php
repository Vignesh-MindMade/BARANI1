<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;

protected $fillable = [
    'banner',
    'gurudev_message',
    'gurudev_image',
    'principal_message',
    'principal_image',
    'principal_quote',
    'principal_name',
];

    protected $table = 'managements';
}

