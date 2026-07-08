<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SustainabilityCertificates extends Model
{
    use HasFactory;
    protected $fillable = [
    'title',
    'image',
    'pdf',
    'sort_id',
];

    protected $table = 'sustainabilities_certificates';
}
