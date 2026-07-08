<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IqacSections extends Model
{
    use HasFactory;
    protected $table = 'iqac_sections';
    protected $fillable = ['name'];
}

