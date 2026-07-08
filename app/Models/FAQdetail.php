<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',

    ];

    protected $table = 'faq_details';
}
