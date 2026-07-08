<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iqac extends Model
{
    use HasFactory;
    protected $table = 'iqac';
    protected $fillable = ['description','section_id'];
    
    
    public function section()
    {
        return $this->belongsTo(IqacSections::class);
    }
}

