<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiefAdvisor extends Model
{
    use HasFactory;

    protected $table = 'chief-advisor';
    protected $fillable = ['name', 'designation','image','description'];


}