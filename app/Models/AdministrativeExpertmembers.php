<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeExpertmembers extends Model
{
    use HasFactory;

    protected $table = 'administrative_expert-members';
    protected $fillable = ['name', 'designation','image'];


}