<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatutoryCommittee extends Model
{
    use HasFactory;

    protected $table = 'statutory_committee';
    protected $fillable = ['committee_content'];
    
     

}
