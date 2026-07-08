<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchigazteHeading extends Model
{
    use HasFactory;

    protected $table = 'archigazette_heading';
    protected $fillable = ['heading'];
}
