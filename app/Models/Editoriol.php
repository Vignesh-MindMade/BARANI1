<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editoriol extends Model
{
    use HasFactory;
    protected $table = 'editoriol';
    protected $fillable = ['editoriol_id','posted_by','posted_on','pdf','image',];

}

