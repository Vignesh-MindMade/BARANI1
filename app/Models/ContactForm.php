<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;
    protected $table = "contact_forms";

    // Columns allowed for mass assignment
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

}
