<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertMember extends Model
{
    use HasFactory;

    protected $table = 'expert-members';
    protected $fillable = ['name', 'designation','image','committee'];


}