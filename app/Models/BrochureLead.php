<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrochureLead extends Model
{
    use HasFactory;
    protected $table = "brochure_lead";

    protected $fillable = [ 
        'name',
        'company_name',
        'email',
        'phone_no',
        'country',
    ];
}
