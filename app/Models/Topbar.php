<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topbar extends Model
{
    use HasFactory;

    protected $table = 'topbars';
    protected $fillable = ['title', 'link_text','link','sort_id'];

}
