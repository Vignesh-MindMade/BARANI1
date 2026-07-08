<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeatcampusCategory extends Model
{
    use HasFactory;
    protected $table = 'lifeatcampus_category';
    protected $fillable = ['name'];
}

