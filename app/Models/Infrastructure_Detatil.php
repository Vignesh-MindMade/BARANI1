<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastructure_Detatil extends Model
{
    use HasFactory;

        
    protected $table = 'infrastructure_detatil';
    protected $fillable = ['Infrastructure_id', 'image','infrastructure_title','infrastructure_thumbnail'];
    
    
    public function infrastructureFront()
    {
        return $this->belongsTo(Infrastructure_front::class, 'Infrastructure_id');
    }

    public function subfolder()
{
    return $this->belongsTo(Infrastrcture_subfolders::class);
}

}
