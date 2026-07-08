<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoverningCouncil extends Model
{
    use HasFactory;

    protected $table = 'governing_council';
    protected $fillable = ['name', 'position','image','mobile','email','message'];
    

}
