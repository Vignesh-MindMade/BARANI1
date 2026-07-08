<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQNew extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'order_id'];
    protected $table = 'faq_new';

}
