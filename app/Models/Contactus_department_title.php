<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus_department_title extends Model
{
    use HasFactory;


    protected $table = 'contactus_department_titles';

    protected $fillable = ['title'];

  public function departments()
    {
        return $this->hasMany(Contactus_department::class)
                    ->orderBy('sort_order', 'asc');
    }
}
