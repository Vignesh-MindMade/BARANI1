<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterContact extends Model
{
    use HasFactory;

    protected $table = 'footer_contact';
    protected $fillable = ['address', 'mail', 'contact_no_1','contact_no_2'];
    
     
}
