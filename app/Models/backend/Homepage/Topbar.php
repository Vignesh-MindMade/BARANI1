<?php

namespace App\Models\Backend\Homepage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topbar extends Model
{
    use HasFactory;

  protected $table = 'topbar';
  protected $fillable =['name','link'];

}
