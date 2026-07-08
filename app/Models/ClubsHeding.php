<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubsHeding extends Model
{

    use HasFactory;

    protected $table = 'clubs_heading';
    protected $fillable = ['title'];


    public function editoriolSection()
    {
        return $this->belongsTo(Clubs::class, 'clubs_id');
    }
    
}
