<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollabrationDetail extends Model
{
    use HasFactory;

    protected $table = 'collaboration_detail';
    protected $fillable = ['collaboration_id', 'image', 'description'];
}
