<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;
    protected $table = 'admission';
    protected $fillable = ['description','section_id','pdf','content','description1','pdf1','description2','pdf2'];
    
    
    public function section()
    {
        return $this->belongsTo(AdmissionSections::class);
    }
    
}

