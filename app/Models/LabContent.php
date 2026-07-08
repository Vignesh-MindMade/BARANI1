<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabContent extends Model
{
    use HasFactory;

    protected $table = 'labs_contents';
    protected $fillable = ['lab_id', 'description'];


 
    
    public function Lab()
    {
        return $this->belongsTo(LabsSections::class);
    }
    

}