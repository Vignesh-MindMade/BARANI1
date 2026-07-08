<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeatCampus extends Model
{
    use HasFactory;
    protected $table = 'life-at-campus';
    protected $fillable = ['category_id','image','description'];
    
    
    public function category()
    {
        return $this->belongsTo(LifeatcampusCategory::class);
    }
}

