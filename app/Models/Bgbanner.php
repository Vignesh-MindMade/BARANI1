<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bgbanner extends Model
{
    use HasFactory;
    protected $table = 'bgbanners';
    protected $fillable = ['image','sort_id'];
}

