<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latestvideo extends Model
{
    use HasFactory;


    protected $table = 'videos';
protected $fillable = ['title','description','sort_id','image2','link'];

}
