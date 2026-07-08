<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results_detail extends Model
{
    use HasFactory;

    protected $table = 'detatil_results';
    protected $fillable = ['Infrastructure_id', 'image','infrastructure_title','infrastructure_thumbnail','pdf','description','url','sort_id'];
    
   
    public function infrastructureFront()
    {
        return $this->belongsTo(Infrastructure_front::class, 'Infrastructure_id');
    }
    
    public function infrastructure()
    {
        return $this->belongsTo(Results_front::class, 'Infrastructure_id', 'id');
    }
}
