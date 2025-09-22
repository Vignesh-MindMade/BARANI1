<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsForm extends Model
{
    use HasFactory;

  protected $table ="contactform";
    protected $fillable = [
    'name',
    'mobile_number',
    'email',
    'subject',
    'message',
];
}
