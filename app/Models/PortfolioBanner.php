<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioBanner extends Model
{
    use HasFactory;
    protected $table = 'portfoliobanner';
    protected $fillable = ['image'];
}

