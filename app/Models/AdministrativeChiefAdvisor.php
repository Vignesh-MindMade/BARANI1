<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeChiefAdvisor extends Model
{
    use HasFactory;

    protected $table = 'administrative_chiefadvisor';
    protected $fillable = ['name', 'designation','image'];


}