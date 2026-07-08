<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastrcture_subfolders extends Model
{

    protected $table = 'infrastructure_subfolder';
    protected $fillable = ['Infrastructure_detatil_id', 'image'];

    public function infrastructureFront()
    {
        return $this->belongsTo(Infrastructure_front::class, 'Infrastructure_id');
    }

}