<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouncilMembers extends Model
{
    use HasFactory;

    protected $table = 'Councilmembers';
    protected $fillable = ['member_name', 'designation','Committee','SortId'];


  

}