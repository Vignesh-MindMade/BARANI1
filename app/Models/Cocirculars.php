<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocirculars extends Model
{
    use HasFactory;

    protected $table = 'co_circulars';
    protected $fillable = ['title','image', 'description'];
}
