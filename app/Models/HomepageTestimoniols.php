<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageTestimoniols extends Model
{
    use HasFactory;

    protected $table = 'homepage_testimoniols';
    protected $fillable = ['name','
    ','feedback','sort_id','image','relationship']; 
}
