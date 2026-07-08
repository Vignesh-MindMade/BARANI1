<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamcellContents extends Model
{
    use HasFactory;
    protected $table = 'examcell_contents';
    protected $fillable = ['text','exam_id'];
    
    
    public function exam()
    {
        return $this->belongsTo(EcamcellSections::class);
    }
}

