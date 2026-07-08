<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus_department extends Model
{
    use HasFactory;

    protected $table = 'contactus_department';

    protected $fillable = [
        'contactus_department_title_id',
        'contactus_department_subtitle',
        'name',
        'phone',
        'mail',
        'desgination',
        'sort_order'
    ];

public function title()
{
    return $this->belongsTo(Contactus_department_title::class, 'contactus_department_title_id');
}
}
