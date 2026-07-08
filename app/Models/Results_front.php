<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results_front extends Model
{
    use HasFactory;

        protected $table = 'front_results';
         protected $fillable = ['title','sort_id'];
}
