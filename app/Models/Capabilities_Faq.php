<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capabilities_Faq extends Model
{
    use HasFactory;
    protected $fillable= [
        'faq_title',
        'faq_question',
        'faq_answers',
    ];
    protected $table='capabilities_faq';
}
