<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationDetatil extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
    
    ];

    protected $table = 'organization_detatils';
}
