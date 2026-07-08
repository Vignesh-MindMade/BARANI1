<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastructure_front extends Model
{
    use HasFactory;

    protected $table = 'infrastructure_front';
    protected $fillable = ['title'];


}
