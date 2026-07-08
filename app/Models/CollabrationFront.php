<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollabrationFront extends Model
{
    use HasFactory;


    protected $table = 'collaboration_front';
    protected $fillable = ['title','catagory_name','catagory_image'];
}
