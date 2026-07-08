<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraySections extends Model
{

    use HasFactory;
    protected $table = 'libraysections';
    protected $fillable = ['description','section_id'];

    public function section()
    {
        return $this->belongsTo(Library::class);
    }
}
