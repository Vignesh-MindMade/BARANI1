<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentSection extends Model
{
    use HasFactory;

    protected $table = 'contnet_section';
    protected $fillable = ['section_id', 'text'];


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    

}