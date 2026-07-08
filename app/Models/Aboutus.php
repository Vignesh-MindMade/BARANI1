<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Aboutus extends Model
{
    use HasFactory;


    protected $table = 'aboutus';

    protected $fillable = [
        'id',
        'banner',
        'chinmaya_history_paragraph',
        'chinmaya_history_paragraph1',
        'chinmaya_vision_paragraph',
        'chinmaya_vision_image',
        'chinmaya_ourvalues_paragraph',
        'chinmaya_ourvalues_image',
        'chinmaya_stakeholders_image',
        'chinmaya_stakeholders_paragraph',
        'created_at',
        'updated_at'
    ];
}
