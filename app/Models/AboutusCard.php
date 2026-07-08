<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutusCard extends Model
{
    use HasFactory;

    protected $table = 'aboutus_cards';
    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'created_at',
        'updated_at'
    ];
}
