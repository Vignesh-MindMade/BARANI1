<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilties extends Model
{
    use HasFactory;

protected $table = 'facilties';
protected $fillable = ['title','description','sort_id','image2'];

}
